<?php

namespace App\Enums;

enum Status: int
{
  case ATIVO = 1;
  case INATIVO = 0;

  public function label(): string
  {
    return match($this) {
      Status::ATIVO => 'Ativo',
      Status::INATIVO => 'Inativo',
    };
  }
}
