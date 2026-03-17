<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Assisted;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AssistedRepository extends AbstractRepository
{
  protected static $model = Assisted::class;

  private static function completeQuery(): Builder
  {
    return self::loadModel()::query()->select([
      'assisteds.*',
      'voluntaries.name as voluntary_name',
      'voluntaries.active  as voluntary_active',
    ])
    ->selectSub(function ($queryAddress) {
      $queryAddress->selectRaw('JSON_OBJECTAGG(addresses.id, JSON_OBJECT("zipcode", addresses.zipcode, "address", addresses.address, "number", addresses.number, "complement", addresses.complement, "neighborhood", addresses.neighborhood, "city", addresses.city, "state", addresses.state)) as addresses_info')
        ->from('addresses')
        ->whereColumn('addresses.id', 'assisteds.address_id');
    }, 'addresses_info')
    ->selectSub(function ($queryContact) {
      $queryContact->selectRaw('JSON_OBJECTAGG(contacts.id, JSON_OBJECT("whatsapp", contacts.phone_number_whatsapp, "phone1", contacts.phone_number2, "phone2", contacts.phone_number2)) as contacts_info')
        ->from('contacts')
        ->whereColumn('contacts.id', 'assisteds.contact_id');
    }, 'contacts_info')
    ->selectSub(function ($queryDependents) {
      $queryDependents->selectRaw('JSON_OBJECTAGG(dependents.id, JSON_OBJECT("name", dependents.name, "parentage", dependents.parentage, "dob", dependents.dob, "sex", dependents.sex, "profession", dependents.profession, "pne", dependents.pne)) as dependents_info')
        ->from('dependents')
        ->whereColumn('dependents.assisted_id', 'assisteds.id');
    }, 'dependents_info')
    ->selectSub(function ($queryIncomes) {
      $queryIncomes->selectRaw('JSON_OBJECTAGG(incomes.id, JSON_OBJECT("name", incomes.name, "value", incomes.incomes)) as incomes_info')
        ->from('incomes')
        ->whereColumn('incomes.assisted_id', 'assisteds.id');
    }, 'incomes_info')
    ->leftJoin('voluntaries', 'assisteds.voluntary_id', '=', 'voluntaries.id')
    ->orderBy('assisteds.id', 'desc');
  }

  public static function getAll() : array {
    return self::loadModel()::all()->toArray();
  }

  public static function findByAssistedName(string $assisted_name)
  {
    return empty($assisted_name)
      ? self::loadModel()::query()
      : self::loadModel()::query()->where('assisteds.name', 'like', '%' . $assisted_name . '%');
  }

  public static function findByAssistedNameComplete(string $assisted_name)
  {
    $query = self::completeQuery();

    return empty($assisted_name)
      ? $query
      : $query->where('assisteds.name', 'like', '%' . $assisted_name . '%');
  }

  public static function findByAddressComplete(string $neighborhood, string $city, string $state): Builder
  {
    $normalizedNeighborhood = mb_strtolower(trim($neighborhood));
    $neighborhoodTerms = array_values(array_filter(
      array_map(
        fn ($term) => '%' . $term . '%',
        preg_split('/\s+/', $normalizedNeighborhood) ?: []
      ),
      fn ($term) => $term !== '%%'
    ));

    if ($neighborhoodTerms === []) {
      $neighborhoodTerms = ['%' . $normalizedNeighborhood . '%'];
    }

    $cityTerm = '%' . mb_strtolower(trim($city)) . '%';
    $stateTerm = '%' . mb_strtoupper(trim($state)) . '%';

    return self::completeQuery()->whereExists(function ($queryAddress) use ($neighborhoodTerms, $cityTerm, $stateTerm) {
      $queryAddress->selectRaw('1')
        ->from('addresses')
        ->whereColumn('addresses.id', 'assisteds.address_id')
        ->where(function ($queryNeighborhood) use ($neighborhoodTerms) {
          foreach ($neighborhoodTerms as $neighborhoodTerm) {
            $queryNeighborhood->orWhereRaw('LOWER(addresses.neighborhood) like ?', [$neighborhoodTerm]);
          }
        })
        ->whereRaw('LOWER(addresses.city) like ?', [$cityTerm])
        ->whereRaw('UPPER(addresses.state) like ?', [$stateTerm]);
    });
  }

  public static function findByIdComplete(int $assistedID)
  {
    return self::completeQuery()->where('assisteds.id', '=', $assistedID)->first();
  }

  public static function findByIdsComplete(array $assistedIDs): Collection
  {
    if ($assistedIDs === []) {
      return new Collection();
    }

    return self::completeQuery()->whereIn('assisteds.id', $assistedIDs)->get();
  }

  public function listPaginate()
  {
    return self::loadModel()::all()->forPage(4, 10);
  }

  public static function findByLastedCreated(int $id)
  {
    return self::loadModel()::query()->join('adresses', 'assisted_id', '=', $id);
  }

  public static function findByLastedCreatedLimited(int $id, int $limit)
  {
    return empty($limit)
      ? self::loadModel()::query()->join('adresses', 'assisted_id', '=', $id)
      : self::loadModel()::query()->join('adresses', 'assisted_id', '=', $id)->limit($limit);

  }
}
