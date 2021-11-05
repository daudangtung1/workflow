<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserRole extends Enum
{
    const MANAGER =   0;
    const STAFF =   1;
    const APPROVER = 2;
}
