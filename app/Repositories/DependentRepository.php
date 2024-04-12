<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Dependent;

class DependentRepository extends AbstractRepository
{
  protected static $model = Dependent::class;

  public static function findByAssistedId(int $assisted_id)
  {
    return self::loadModel()::query()->where(['assisted_id' => $assisted_id]);
  }

  public static function findByDependentName(string $dependent_name)
  {
    return empty($dependent_name)
      ? self::loadModel()::query()
      : self::loadModel()::query()->where('name', 'like', '%' . $dependent_name . '%');
  }
}
