<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Voluntary;

class VoluntaryRepository extends AbstractRepository
{
  protected static $model = Voluntary::class;

  public static function findByVoluntaryName(string $voluntary_name)
  {
    return empty($voluntary_name)
      ? self::loadModel()::all()
      : self::loadModel()::query()->where('voluntaries.name', 'like', '%' . $voluntary_name . '%');
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
    return self::loadModel()::query()->join('adresses', 'assisted_id', '=', $id);
  }
}
