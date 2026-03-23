<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\Assisted;
use App\Models\Contact;
use App\Models\Dependent;
use App\Models\Income;
use App\Repositories\AssistedRepository;
use Illuminate\Support\Facades\DB;

class AssistedService
{
  public function createWithRelations(
    array $assistedData,
    array $contactData,
    array $addressData,
    array $dependentsData = [],
    array $incomesData = []
  ): Assisted {
    return DB::transaction(function () use ($assistedData, $contactData, $addressData, $dependentsData, $incomesData): Assisted {
      $contactId = Contact::query()->create($contactData)->id;
      $addressId = Address::query()->create($addressData)->id;

      /** @var Assisted $assisted */
      $assisted = AssistedRepository::create(array_merge($assistedData, [
        'contact_id' => $contactId,
        'address_id' => $addressId,
      ]));

      $this->syncDependents($assisted->id, $dependentsData);
      $this->syncIncomes($assisted->id, $incomesData);

      return $assisted;
    });
  }

  public function updateWithRelations(
    int $id,
    array $assistedData,
    array $contactData,
    array $addressData,
    array $dependentsData = [],
    array $incomesData = []
  ): int {
    $assisted = AssistedRepository::find($id);

    if (!$assisted) {
      return 0;
    }

    return DB::transaction(function () use ($id, $assisted, $assistedData, $contactData, $addressData, $dependentsData, $incomesData): int {
      if ($assisted->contact_id) {
        Contact::query()->where('id', $assisted->contact_id)->update($contactData);
      }

      if ($assisted->address_id) {
        Address::query()->where('id', $assisted->address_id)->update($addressData);
      }

      $updated = AssistedRepository::update($id, $assistedData);

      $this->syncDependents($id, $dependentsData);
      $this->syncIncomes($id, $incomesData);

      return $updated;
    });
  }

  public function deleteWithRelations(int $id): int
  {
    $assisted = AssistedRepository::find($id);

    if (!$assisted) {
      return 0;
    }

    return DB::transaction(function () use ($id, $assisted): int {
      Dependent::query()->where('assisted_id', $id)->delete();
      Income::query()->where('assisted_id', $id)->delete();

      $deleted = AssistedRepository::delete($id);

      if (!$deleted) {
        return 0;
      }

      if ($assisted->contact_id) {
        Contact::query()->where('id', $assisted->contact_id)->delete();
      }

      if ($assisted->address_id) {
        Address::query()->where('id', $assisted->address_id)->delete();
      }

      return $deleted;
    });
  }

  private function syncDependents(int $assistedId, array $dependentsData): void
  {
    $existingIds = Dependent::query()
      ->where('assisted_id', $assistedId)
      ->pluck('id')
      ->map(fn ($id) => (int) $id)
      ->toArray();

    $submittedIds = array_values(array_filter(array_map(
      static fn (array $dependent): ?int => isset($dependent['id']) && $dependent['id'] !== null ? (int) $dependent['id'] : null,
      $dependentsData
    )));

    $idsToDelete = array_diff($existingIds, $submittedIds);

    if ($idsToDelete !== []) {
      Dependent::query()->whereIn('id', $idsToDelete)->delete();
    }

    foreach ($dependentsData as $dependentData) {
      $payload = [
        'name' => $dependentData['name'] ?? null,
        'dob' => $dependentData['dob'] ?? null,
        'sex' => $dependentData['sex'] ?? null,
        'parentage' => $dependentData['parentage'] ?? null,
        'profession' => $dependentData['profession'] ?? null,
        'pne' => (bool) ($dependentData['pne'] ?? false),
        'assisted_id' => $assistedId,
      ];

      if (!empty($dependentData['id'])) {
        Dependent::query()->where('id', (int) $dependentData['id'])->update($payload);
        continue;
      }

      Dependent::query()->create($payload);
    }
  }

  private function syncIncomes(int $assistedId, array $incomesData): void
  {
    $existingIds = Income::query()
      ->where('assisted_id', $assistedId)
      ->pluck('id')
      ->map(fn ($id) => (int) $id)
      ->toArray();

    $submittedIds = array_values(array_filter(array_map(
      static fn (array $income): ?int => isset($income['id']) && $income['id'] !== null ? (int) $income['id'] : null,
      $incomesData
    )));

    $idsToDelete = array_diff($existingIds, $submittedIds);

    if ($idsToDelete !== []) {
      Income::query()->whereIn('id', $idsToDelete)->delete();
    }

    foreach ($incomesData as $incomeData) {
      $payload = [
        'name' => $incomeData['name'] ?? null,
        'incomes' => isset($incomeData['incomes']) ? (float) $incomeData['incomes'] : null,
        'assisted_id' => $assistedId,
      ];

      if (!empty($incomeData['id'])) {
        Income::query()->where('id', (int) $incomeData['id'])->update($payload);
        continue;
      }

      Income::query()->create($payload);
    }
  }
}
