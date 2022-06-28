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
        $listYear=$this->vacationService->listYear();

        return view('staff.vacation.index', [
            'listVacation' => $listVacation,
            'listCalendar' => $listCalendar,
            'listYear' => $listYear
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            if ($request->type != 'vacation') {
                $request->start_time_1 = null;
                $request->end_time_1 = null;
                $request->start_time_2 = null;
                $request->end_time_2 = null;
                $total_time = '';
            }
            else{
                if (!$request->start_time_1 || !$request->end_time_1) return back()->with('error', '期間が無効になっている');
                $datetime_start_1 = strtotime(substr($request->start_date, 0, -6) . " " . $request->start_time_1);
                $datetime_end_1 =  strtotime(substr($request->end_date, 0, -6) . " " . $request->end_time_1);

                $date_sub_total_1 = ($datetime_end_1 - $datetime_start_1) / 3600;
                if ($datetime_end_1 < $datetime_start_1) return back()->with('error', '期間が無効になっている');

                if (!$request->start_time_2 || !$request->end_time_2) {

                    $total_hour_1 = floor($date_sub_total_1);
                    $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
                    $total_time = $total_hour_1 . ':' . $total_minutes_1;
                } else {
                    $datetime_start_2 = strtotime(substr($request->start_date, 0, -6) . " " . $request->start_time_2);
                    $datetime_end_2 = strtotime(substr($request->end_date, 0, -6) . " " . $request->end_time_2);
                    if ($datetime_end_2 < $datetime_start_2) return back()->with('error', '期間が無効になっている');
                    $date_sub_total_2 = ($datetime_end_2 - $datetime_start_2) / 3600;
                    
                    $total_hour_1 = floor($date_sub_total_1);
                    $total_hour_2 = floor($date_sub_total_2);
                    $total_hour = $total_hour_1 + $total_hour_2;

                    $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
                    $total_minutes_2 = $date_sub_total_2 * 60 - ($total_hour_2 * 60);
                    $total_minutes = $total_minutes_1 + $total_minutes_2;

                    $total_time = $total_hour . ':' .  $total_minutes;
                }
            }
            $data = [
                'user_id' => $user->id,
                'start_date' => substr($request->start_date, 0, -6),
                'end_date' => substr($request->end_date, 0, -6),
                'reason' => $request->reason,
                'type' => $request->type  == 'vacation' ? 'vacation' : $request->type,
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
        if ($request->type != 'vacation') {
            $request->start_time_1 = null;
            $request->end_time_1 = null;
            $request->start_time_2 = null;
            $request->end_time_2 = null;
            $total_time = '';
        }
        else{
            if (!$request->start_time_1 || !$request->end_time_1) return back()->with('error', '期間が無効になっている');
            $datetime_start_1 = strtotime(substr($request->start_date, 0, -6) . " " . $request->start_time_1);
            $datetime_end_1 =  strtotime(substr($request->end_date, 0, -6) . " " . $request->end_time_1);

            $date_sub_total_1 = ($datetime_end_1 - $datetime_start_1) / 3600;
            if ($date_sub_total_1 <= 0 && $request->type == 0 && $request->type == 3 && $request->type == 6) return back()->with('error', '期間が無効になっている');

            if (!$request->start_time_2 || !$request->end_time_2) {
                $total_hour_1 = floor($date_sub_total_1);
                $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
                $total_time = $total_hour_1 . ':' . $total_minutes_1;
            } else {
                $datetime_start_2 = strtotime(substr($request->start_date, 0, -6) . " " . $request->start_time_2);
                $datetime_end_2 = strtotime(substr($request->end_date, 0, -6) . " " . $request->end_time_2);
                $date_sub_total_2 = ($datetime_end_2 - $datetime_start_2) / 3600;
                if ($date_sub_total_1 <= 0 && $request->type == 0 && $request->type == 3 && $request->type == 6) return back()->with('error', '期間が無効になっている');
                if ($date_sub_total_2 <= 0 && $request->type == 0 && $request->type == 3 && $request->type == 6) return back()->with('error', '期間が無効になっている');
                $total_hour_1 = floor($date_sub_total_1);
                $total_hour_2 = floor($date_sub_total_2);
                $total_hour = $total_hour_1 + $total_hour_2;

                $total_minutes_1 = $date_sub_total_1 * 60 - ($total_hour_1 * 60);
                $total_minutes_2 = $date_sub_total_2 * 60 - ($total_hour_2 * 60);
                $total_minutes = $total_minutes_1 + $total_minutes_2;

                $total_time = $total_hour . ':' .  $total_minutes;
            }
        }

        $data = [
            'start_date' => substr($request->start_date, 0, -6),
            'end_date' => substr($request->end_date, 0, -6),
            'reason' => $request->reason,
            'start_time_1' => $request->start_time_1,
            'end_time_1' => $request->end_time_1,
            'start_time_2' => $request->start_time_2,
            'end_time_2' => $request->end_time_2,
            'total_time' => $total_time,
            'type' => $request->type  == 'vacation' ? 'vacation' : $request->type,
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
