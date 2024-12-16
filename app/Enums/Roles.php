<?php

namespace App\Enums;

enum Roles: string
{
  case ADMINISTRATIVO = 'Administrativo';
  case SECRETARIO = 'Secretário';
  case VOLUNTARIO = 'Voluntário';
}
