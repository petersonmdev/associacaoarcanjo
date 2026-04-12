<?php

namespace App\Enums;

enum Relationships: string
{
  case AVO = 'Avô';
  case AVOA = 'Avó';
  case ENTEADA = 'Enteada';
  case ENTEADO = 'Enteado';
  case ESPOSA = 'Esposa';
  case FILHA = 'Filha';
  case FILHA_ADOTIVA = 'Filha adotiva';
  case FILHO = 'Filho';
  case FILHO_ADOTIVO = 'Filho adotivo';
  case IRMA = 'Irmã';
  case IRMAO = 'Irmão';
  case MADRASTA = 'Madrasta';
  case MAE = 'Mãe';
  case MAE_ADOTIVA = 'Mãe adotiva';
  case MARIDO = 'Marido';
  case NETA = 'Neta';
  case NETO = 'Netinho';
  case PADRASTO = 'Padrasto';
  case PAI = 'Pai';
  case PAI_ADOTIVO = 'Pai adotivo';
  case PRIMA = 'Prima';
  case PRIMO = 'Primo';
  case SOBRINHA = 'Sobrinha';
  case SOBRINHO = 'Sobrinho';
  case TIA = 'Tia';
  case TIO = 'Tio';

  public static function labelFrom(?string $raw): ?string
  {
    if ($raw === null || $raw === '') {
      return null;
    }

    $byValue = self::tryFrom($raw);
    if ($byValue instanceof self) {
      return $byValue->value;
    }

    $const = self::class . '::' . $raw;
    if (defined($const)) {
      $case = constant($const);
      if ($case instanceof self) {
        return $case->value;
      }
    }

    return $raw;
  }
}
