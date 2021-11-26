<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class BaseEnum extends Enum implements LocalizedEnum
{

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
