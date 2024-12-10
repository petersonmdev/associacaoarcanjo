<?php

namespace App\Enums;

enum EducationLevel: string
{
  case FUNDAMENTAL_INCOMPLETO = 'Ensino Fundamental Incompleto';
  case FUNDAMENTAL_COMPLETO = 'Ensino Fundamental Completo';
  case MEDIO_INCOMPLETO = 'Ensino Médio Incompleto';
  case MEDIO_COMPLETO = 'Ensino Médio Completo';
  case SUPERIOR_INCOMPLETO = 'Ensino Superior Incompleto';
  case SUPERIOR_COMPLETO = 'Ensino Superior Completo';
  case POS_GRADUACAO_INCOMPLETO = 'Pós-graduação Incompleto';
  case POS_GRADUACAO_COMPLETO = 'Pós-graduação Completo';
  case MESTRADO_INCOMPLETO = 'Mestrado Incompleto';
  case MESTRADO_COMPLETO = 'Mestrado Completo';
  case DOUTORADO_INCOMPLETO = 'Doutorado Incompleto';
  case DOUTORADO_COMPLETO = 'Doutorado Completo';
}
