<?php

namespace App\Enums;

enum Gender: string
{
  case MASCULINO = 'Masculino';
  case FEMININO = 'Feminino';
  case NAO_BINARIO = 'Não binário';
  case PREFIRO_NAO_INFORMAR = 'Prefiro não informar';
  case OUTRO = 'Outro';
}
