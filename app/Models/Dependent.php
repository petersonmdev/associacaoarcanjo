<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

  protected $fillable = [
    'name',
    'parentage',
    'dob',
    'sex',
    'profession',
    'pne',
    'assisted_id'
  ];
}
