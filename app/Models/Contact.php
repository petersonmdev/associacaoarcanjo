<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

  protected $fillable = [
    'phone_number_whatsapp',
    'phone_number1',
    'phone_number2'
  ];
}
