<?php

namespace App\Http\Controllers\Staff;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Staff\VacationService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VacationController extends Controller
{
    protected $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function index()
    {
        $listVacation =  $this->vacationService->listVacation();
        $listCalendar =  $this->vacationService->listCalendar();

        return view('staff.vacation.index', [
            'listVacation' => $listVacation,
            'listCalendar' => $listCalendar,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            if ($request->type == 5 || $request->type == 4 || $request->type == 1 || $request->type == 2) {
                $request->start_time = null;
                $request->end_time = null;
                $total_time = '';
            }
            if (!$request->start_time_1 || !$request->end_time_1) return back()->with('error', 'Invalid time 1!');
            $datetime_start_1 = strtotime($request->start_date . " " . $request->start_time_1);
            $datetime_end_1 =  strtotime($request->end_date . " " . $request->end_time_1);

            $date_sub_total_1 = ($datetime_end_1 - $datetime_start_1) / 3600;
            if ($datetime_end_1 < $datetime_start_1) return back()->with('error', 'Date and time input wrong!');

            if (!$request->start_time_2 || !$request->end_time_2) {

                $total_hour_1 = floor($date_sub_total_1);
                $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
                $total_time = $total_hour_1 . ':' . $total_minutes_1;
            } else {
                $datetime_start_2 = strtotime($request->start_date . " " . $request->start_time_2);
                $datetime_end_2 = strtotime($request->end_date . " " . $request->end_time_2);
                if ($datetime_end_2 < $datetime_start_2) return back()->with('error', 'Date and time input wrong!');
                $date_sub_total_2 = ($datetime_end_2 - $datetime_start_2) / 3600;
                
                $total_hour_1 = floor($date_sub_total_1);
                $total_hour_2 = floor($date_sub_total_2);
                $total_hour = $total_hour_1 + $total_hour_2;

                $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
                $total_minutes_2 = $date_sub_total_2 * 60 - ($total_hour_2 * 60);
                $total_minutes = $total_minutes_1 + $total_minutes_2;

                $total_time = $total_hour . ':' .  $total_minutes;
            }

            $data = [
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
                'type' => $request->type  == 'vacation' ? $request->option_vacation : $request->type,
                'start_time_1' => $request->start_time_1,
                'end_time_1' => $request->end_time_1,
                'start_time_2' => $request->start_time_2,
                'end_time_2' => $request->end_time_2,
                'total_time' => $total_time,
            ];
            $this->vacationService->createVacation($data);

            return redirect()->route('staff-vacation.index')->with('success', __('common.create.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        $listVacation =  $this->vacationService->listVacation();

        $infoVacation =  $this->vacationService->infoVacation($id);

        $listCalendar =  $this->vacationService->listCalendar();

        return view('staff.vacation.index', [
            'listVacation' => $listVacation,
            'infoVacation' => $infoVacation,
            'listCalendar' => $listCalendar,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->type == 5 || $request->type == 4 || $request->type == 1 || $request->type == 2) {
            $request->start_time = null;
            $request->end_time = null;
            $total_time = '';
        }
        if (!$request->start_time_1 || !$request->end_time_1) return back()->with('error', 'Invalid time 1!');
        $datetime_start_1 = strtotime($request->start_date . " " . $request->start_time_1);
        $datetime_end_1 =  strtotime($request->end_date . " " . $request->end_time_1);

        $date_sub_total_1 = ($datetime_end_1 - $datetime_start_1) / 3600;
        if ($date_sub_total_1 <= 0 && $request->type == 0 && $request->type == 3 && $request->type == 6) return back()->with('error', 'Date and time input wrong!');

        if (!$request->start_time_2 || !$request->end_time_2) {
            $total_hour_1 = floor($date_sub_total_1);
            $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
            $total_time = $total_hour_1 . ':' . $total_minutes_1;
        } else {
            $datetime_start_2 = strtotime($request->start_date . " " . $request->start_time_2);
            $datetime_end_2 = strtotime($request->end_date . " " . $request->end_time_2);
            $date_sub_total_2 = ($datetime_end_2 - $datetime_start_2) / 3600;
            if ($date_sub_total_1 <= 0 && $request->type == 0 && $request->type == 3 && $request->type == 6) return back()->with('error', 'Date and time input wrong!');
            if ($date_sub_total_2 <= 0 && $request->type == 0 && $request->type == 3 && $request->type == 6) return back()->with('error', 'Date and time input wrong!');
            $total_hour_1 = floor($date_sub_total_1);
            $total_hour_2 = floor($date_sub_total_2);
            $total_hour = $total_hour_1 + $total_hour_2;

            $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
            $total_minutes_2 = $date_sub_total_2 * 60 - ($total_hour_2 * 60);
            $total_minutes = $total_minutes_1 + $total_minutes_2;

            $total_time = $total_hour . ':' .  $total_minutes;
        }

        $data = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time_1' => $request->start_time_1,
            'end_time_1' => $request->end_time_1,
            'start_time_2' => $request->start_time_2,
            'end_time_2' => $request->end_time_2,
            'total_time' => $total_time,
        ];
        $this->vacationService->updateVacation($data, $id);

        return redirect()->route('staff-vacation.index')->with('success', __('common.update.success'));
    }
    public function destroy($id)
    {
        try {
            $this->vacationService->delete($id);

            return redirect()->route('staff-vacation.index')->with('success', __('common.delete.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
