<?php

namespace App\Enums;

enum CivilStatus: string
{
  case CASADO = 'Casado(a)';
  case DIVORCIADO = 'Divorciado(a)';
  case SEPARADO = 'Separado(a)';
  case SOLTEIRO = 'Solteiro(a)';
  case UNIAO_ESTAVEL = 'União Estável';
  case VIUVO = 'Viúvo(a)';
}
