<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Voluntary;
use Illuminate\Database\Eloquent\Builder;

class VoluntaryRepository extends AbstractRepository
{
  protected static $model = Voluntary::class;

  private static function completeQuery(): Builder
  {
    return self::loadModel()::query()->select([
      'voluntaries.*',
    ])
    ->selectSub(function ($queryAssistedList) {
      $queryAssistedList->selectRaw('JSON_ARRAYAGG(JSON_OBJECT("id", assisteds.id, "name", assisteds.name, "dob", assisteds.dob, "active", assisteds.active))')
        ->from('assisteds')
        ->whereColumn('assisteds.voluntary_id', 'voluntaries.id');
    }, 'assisteds')
    ->selectSub(function ($queryAddress) {
      $queryAddress->selectRaw('JSON_OBJECTAGG(addresses.id, JSON_OBJECT("zipcode", addresses.zipcode, "address", addresses.address, "number", addresses.number, "complement", addresses.complement, "neighborhood", addresses.neighborhood, "city", addresses.city, "state", addresses.state)) as addresses_info')
        ->from('addresses')
        ->whereColumn('addresses.id', 'voluntaries.address_id');
    }, 'addresses_voluntary_info')
    ->selectSub(function ($queryAddress) {
      $queryAddress->selectRaw('JSON_OBJECTAGG(addresses.id, JSON_OBJECT("neighborhood", addresses.neighborhood)) as addresses_info')
        ->from('addresses')
        ->join('assisteds', 'assisteds.address_id', '=', 'addresses.id')
        ->whereColumn('assisteds.voluntary_id', 'voluntaries.id');
    }, 'addresses_assisted_info')
    ->selectSub(function ($queryAssisted) {
      $queryAssisted->selectRaw('COUNT(*)')
        ->from('assisteds')
        ->whereColumn('assisteds.voluntary_id', 'voluntaries.id');
    }, 'assisteds_count')
    ->selectSub(function ($queryContact) {
      $queryContact->selectRaw('JSON_OBJECT("whatsapp", contacts.phone_number_whatsapp, "phone1", contacts.phone_number1, "phone2", contacts.phone_number2) as contacts_info')
        ->from('contacts')
        ->whereColumn('contacts.id', 'voluntaries.contact_id');
    }, 'contacts_info')
    ->orderBy('voluntaries.id', 'desc');
  }

  public static function findByVoluntaryName(string $voluntary_name)
  {
    return empty($voluntary_name)
      ? self::loadModel()::all()
      : self::loadModel()::query()->where('voluntaries.name', 'like', '%' . $voluntary_name . '%');
  }

  public static function findByVoluntaryNameComplete(string $voluntary_name)
  {
    $query = self::completeQuery();

    return empty($voluntary_name)
      ? $query
      : $query->where('voluntaries.name', 'like', '%' . $voluntary_name . '%');
  }

  public static function findVoluntaryAndAddressByName(string $voluntary_name)
  {
    $query = self::loadModel()::query()->select([
      'voluntaries.*',
      'addresses.*'
    ])
    ->join('address', 'voluntaries.address_id', '=', 'addresses.id')
    ->orderBy('voluntaries.id', 'desc');

    return empty($voluntary_name)
      ? $query
      : $query->where('voluntaries.name', 'like', '%' . $voluntary_name . '%');
  }

  public function listPaginate()
  {
    return self::loadModel()::all()->forPage(4, 10);
  }

  public static function findByLastedCreated(int $id)
  {
    return self::loadModel()::query()->join('addresses', 'voluntaries.address_id', '=', 'addresses.id')->where('voluntaries.id', '=', $id);
  }
}
