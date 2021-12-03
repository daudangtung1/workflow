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
                case 'monthdate':
                    return Carbon::parse($param)->format('m-d H:i');
                    break;
                default:
                    return '';
            }
        }

        return '';
    }

    public function getDayOfWeek($day)
    {
        $arr = [
            0 => 'Sun',
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
        ];

        return $arr[Carbon::parse($day)->dayOfWeek];
    }

    public function getMonth($date)
    {
        $prev = Carbon::parse($date)->subMonths();
        $next = Carbon::parse($date)->addMonth();

        return [
            'prev' => Carbon::parse($prev)->format('Y-m'),
            'current' => Carbon::parse($date)->format('Y-m'),
            'current_text' => Carbon::parse($date)->format('Y年m月'),
            'next' => Carbon::parse($next)->format('Y-m'),
            'next_text' => Carbon::parse($next)->format('Y年m月'),
        ];
    }


    public function scopeDate($from, $to, $callback)
    {
        $begin = new \DateTime($from);
        $end   = new \DateTime($to);

        $arrDate = [];

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $date = $i->format("Y-m-d");
            $arrDate[$date ] = $callback;
            $arrDate[$date]['date'] = $date . ' (' . $this->getDayOfWeek($date) . ')';
            

        }

        return $arrDate;
    }
}
