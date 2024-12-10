<?php

namespace App\Enums;

enum CivilStatus: string
{
  case SOLTEIRO = 'Solteiro(a)';
  case CASADO = 'Casado(a)';
  case DIVORCIADO = 'Divorciado(a)';
  case VIUVO = 'Viúvo(a)';
  case SEPARADO = 'Separado(a)';
  case UNIAO_ESTAVEL = 'União Estável';
}
