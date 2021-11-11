<?php

namespace App\Services;

use Carbon\Carbon;

class BaseService
{
    protected $model;

    public function formatTime($param, $type = 'time')
    {
        if ($param) {
            switch ($type) {
                case 'time':
                    return Carbon::parse($param)->format('H:i');
                    break;
                case 'datetime':
                    return Carbon::parse($param)->format('Y-m-d H:i');
                    break;
                default:
                    return '';
            }
        }

        return '';
    }
}
