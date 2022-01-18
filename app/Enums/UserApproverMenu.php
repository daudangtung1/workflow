<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserApproverMenu extends Enum
{
    const NOT_SHOW = 0;
    const SHOW = 1;
}
