<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository extends AbstractRepository
{
  protected static $model = Contact::class;

  public static function findByAssistedId(int $assisted_id)
  {
    return self::loadModel()::query()->where(['assisted_id' => $assisted_id])->first();
  }

  public static function findByVoluntaryId(int $voluntary_id)
  {
    return self::loadModel()::query()->where(['voluntary_id' => $voluntary_id])->first();
  }

  public static function findByDonorId(int $donor_id)
  {
    return self::loadModel()::query()->where(['donor_id' => $donor_id])->first();
  }
}
