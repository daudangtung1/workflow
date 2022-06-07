<?php

namespace App\Enums;

use App\Enums\BaseEnum;

final class ManagerStatus extends BaseEnum
{
    const PENDING = 1;
    const PROCESSED = 2;
    const ALL = 3;
}
