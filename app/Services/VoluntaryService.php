<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\Assisted;
use App\Models\Contact;
use App\Models\User;
use App\Models\Voluntary;
use App\Repositories\VoluntaryRepository;
use Illuminate\Support\Facades\DB;

class VoluntaryService
{
  public function createWithRelations(
    array $voluntaryData,
    array $contactData,
    array $addressData,
    ?array $userData = null,
    array $assistedIds = []
  ): Voluntary {
    return DB::transaction(function () use ($voluntaryData, $contactData, $addressData, $userData, $assistedIds): Voluntary {
      $userId = $userData !== null
        ? User::query()->create($userData)->id
        : null;

      $contactId = Contact::query()->create($contactData)->id;
      $addressId = Address::query()->create($addressData)->id;

      /** @var Voluntary $voluntary */
      $voluntary = VoluntaryRepository::create(array_merge($voluntaryData, [
        'user_id' => $userId,
        'contact_id' => $contactId,
        'address_id' => $addressId,
      ]));

      $this->syncAssisteds($voluntary->id, $assistedIds);

      return $voluntary;
    });
  }

  public function updateWithRelations(
    int $id,
    array $voluntaryData,
    array $contactData,
    array $addressData,
    array $assistedIds = []
  ): int {
    $voluntary = VoluntaryRepository::find($id);

    if (!$voluntary) {
      return 0;
    }

    return DB::transaction(function () use ($id, $voluntary, $voluntaryData, $contactData, $addressData, $assistedIds): int {
      if ($voluntary->contact_id) {
        Contact::query()->where('id', $voluntary->contact_id)->update($contactData);
      }

      if ($voluntary->address_id) {
        Address::query()->where('id', $voluntary->address_id)->update($addressData);
      }

      $updated = VoluntaryRepository::update($id, $voluntaryData);

      $this->syncAssisteds($id, $assistedIds);

      return $updated;
    });
  }

  public function deleteWithRelations(int $id): int
  {
    $voluntary = VoluntaryRepository::find($id);

    if (!$voluntary) {
      return 0;
    }

    return DB::transaction(function () use ($id, $voluntary): int {
      $deleted = VoluntaryRepository::delete($id);

      if (!$deleted) {
        return 0;
      }

      if ($voluntary->user_id) {
        User::query()->where('id', $voluntary->user_id)->delete();
      }

      if ($voluntary->contact_id) {
        Contact::query()->where('id', $voluntary->contact_id)->delete();
      }

      if ($voluntary->address_id) {
        Address::query()->where('id', $voluntary->address_id)->delete();
      }

      return $deleted;
    });
  }

  private function syncAssisteds(int $voluntaryId, array $assistedIds): void
  {
    $normalizedIds = array_values(array_unique(array_map('intval', $assistedIds)));

    if ($normalizedIds === []) {
      Assisted::query()
        ->where('voluntary_id', $voluntaryId)
        ->update(['voluntary_id' => null]);

      return;
    }

    Assisted::query()
      ->where('voluntary_id', $voluntaryId)
      ->whereNotIn('id', $normalizedIds)
      ->update(['voluntary_id' => null]);

    Assisted::query()
      ->whereIn('id', $normalizedIds)
      ->update(['voluntary_id' => $voluntaryId]);
  }
}
