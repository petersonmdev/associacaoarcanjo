<?php

namespace App\Enums;

enum Driving: string
{
  case NONE = 'Não possui condução';
  case MOTO = 'Moto';
  case CARRO = 'Carro';
  case PICAPE = 'Picape';
}
