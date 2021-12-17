<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class VacationType extends Enum implements LocalizedEnum
{
    const FULL_DAY = 0;
    const MORNING = 1;
    const AFTERNOON = 2;

    const FULL_DAY_SPECIAL = 3;
    const MORNING_SPECIAL = 4;
    const AFTERNOON_SPECIAL = 5;



    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
