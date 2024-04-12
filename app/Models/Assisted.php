<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assisted extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'email',
      'taxvat',
      'dob',
      'civil_status',
      'education_level',
      'profession',
      'jobless',
      'active',
      'life_history',
      'health_history',
      'continuous_medication',
      'voluntary_id',
      'contact_id',
      'address_id',
    ];
}
