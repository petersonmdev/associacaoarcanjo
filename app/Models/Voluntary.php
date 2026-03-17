<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntary extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'address_id',
      'contact_id',
      'name',
      'email',
      'taxvat',
      'dob',
      'driving',
      'active',
    ];
}
