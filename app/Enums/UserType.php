<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserType extends Enum implements LocalizedEnum
{
    const FULLTIME = 1;

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
