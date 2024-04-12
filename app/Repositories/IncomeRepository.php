<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Income;

class IncomeRepository extends AbstractRepository
{
  protected static $model = Income::class;

  public static function findByAssistedId(int $assisted_id)
  {
    return self::loadModel()::query()->where(['assisted_id' => $assisted_id])->first();
  }
}
