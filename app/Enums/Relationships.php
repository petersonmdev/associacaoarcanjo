<?php

namespace App\Enums;

enum Relationships: string
{
  case PAI = 'Pai';
  case MAE = 'Mãe';
  case FILHO = 'Filho';
  case FILHA = 'Filha';
  case IRMAO = 'Irmão';
  case IRMA = 'Irmã';
  case TIO = 'Tio';
  case TIA = 'Tia';
  case SOBRINHO = 'Sobrinho';
  case SOBRINHA = 'Sobrinha';
  case AVO = 'Avô';
  case AVOA = 'Avó';
  case NETO = 'Netinho';
  case NETA = 'Neta';
  case PRIMO = 'Primo';
  case PRIMA = 'Prima';
  case PADRASTO = 'Padrasto';
  case MADRASTA = 'Madrasta';
  case ENTEADO = 'Enteado';
  case ENTEADA = 'Enteada';
  case PAI_ADOTIVO = 'Pai adotivo';
  case MAE_ADOTIVA = 'Mãe adotiva';
  case FILHO_ADOTIVO = 'Filho adotivo';
  case FILHA_ADOTIVA = 'Filha adotiva';
}
