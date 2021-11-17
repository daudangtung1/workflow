<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AbsenceOption extends Enum implements LocalizedEnum
{
    const FIRST = 1;
    const SECOND = 2;
    const THIRD = 3;

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
