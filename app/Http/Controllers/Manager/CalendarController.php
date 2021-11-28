<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->year) {
            $request->year = Carbon::now()->year;
        }

        $request->year_text = $request->year . '年';
        $request->prev = Carbon::parse($request->year . '-01')->subYears()->year;
        $request->next = Carbon::parse($request->year . '-01')->addYear()->year;

        return view('manager.calendar.index', [
            'calendar' => $this->dayOfYear($request->year),
            'arrCalendar' => $this->listCalendar($request->year)
        ]);
    }

    public function store(Request $request)
    {
        if ($request->day) {
            $userId = auth()->user()->id;
            $arrDate = $this->dayOfYear($request->year);
            $from = $arrDate[0]['day'];
            $to = $arrDate[count($arrDate) - 1]['day'];

            Calendar::whereBetween('date', [$from, $to])
                ->where('user_id', $userId)
                ->delete();

            foreach ($request->day as $item) {
                Calendar::create([
                    'user_id' => $userId,
                    'date' => $item,
                ]);
            }
        }

        return redirect()->back()->with('success',  __('common.update.success'));
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

    public function listCalendar($year)
    {
        $userId = auth()->user()->id;
        $arrDate = $this->dayOfYear($year);
        $from = $arrDate[0]['day'];
        $to = $arrDate[count($arrDate) - 1]['day'];

        $listCalendar =  Calendar::whereBetween('date', [$from, $to])
            ->where('user_id', $userId)
            ->get();

        $arrCalendar = [];

        foreach ($listCalendar as $item) {
            $arrCalendar[$item['date']] = true;
        }

        return $arrCalendar;
    }
}
