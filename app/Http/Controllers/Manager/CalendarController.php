<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->year)
            $request->year = Carbon::now()->year;

        return view('manager.calendar.index', [
            'calendar' => $this->dayOfYear($request->year)
        ]);
    }

    public function dayOfYear($year)
    {
        $arrDay = [];

        $arrColor = [
            1 => '#D9EDF7',
            2 => '#F2DEDE',
            3 => '#e2def2',
            4 => '#f2f2de',
            5 => '#def0f2',
            6 => '#dee0f2',
            7 => '#f2e5de',
            8 => '#f2deec',
            9 => '#def2ed',
            10 => '#e9f2de',
            11 => '#f2dee2',
            12 => '#DFF0D8',
        ];

        //check day of week . 0 is sunday
        $firstDayOfWeek = Carbon::parse($year . '-01-01')->dayOfWeek;
        $dayOfMonth = Carbon::parse($year - 1)->daysInMonth;

        if ($firstDayOfWeek != 0) {
            for ($i = ($dayOfMonth - $firstDayOfWeek + 1); $i <= $dayOfMonth; $i++) {
                // $month = $year . '-' . $i;
                $arrDay[] = [
                    'day' => ($year - 1) . '-12-' . $i,
                    'week' => Carbon::parse(($year - 1) . '-12-' . $i)->dayOfWeek,
                    'color' => $arrColor[12],
                ];
            }
        }

        for ($i = 1; $i <= 12; $i++) {
            $month = $year . '-' . $i;
            $dayOfMonth = Carbon::parse($month)->daysInMonth;


            for ($day = 1; $day <= $dayOfMonth; $day++) {
                $dayNow = $year . '-' . ($i < 10 ? '0' . $i : $i) . '-' . ($day < 10 ? '0' . $day : $day);
                $arrDay[] = [
                    'day' => $dayNow,
                    'week' => Carbon::parse($dayNow)->dayOfWeek,
                    'color' => $arrColor[$i],
                ];
            }
        }

        //check day of week . 6 is saturday
        $lastDayOfWeek = Carbon::parse($year . '-12-31')->dayOfWeek;

        if ($lastDayOfWeek != 6) {
            for ($i = 1; $i <= 6 - $lastDayOfWeek; $i++) {
                $arrDay[] = [
                    'day' => $year + 1 . '-01-0' . $i,
                    'week' => Carbon::parse($year + 1 . '-01-0' . $i)->dayOfWeek,
                    'color' => $arrColor[1],
                ];
            }
        }

        return $arrDay;
    }
}
