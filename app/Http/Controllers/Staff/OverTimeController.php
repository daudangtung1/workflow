<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Staff\OverTimeService;

class OverTimeController extends Controller
{
    protected $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function index(Request $request)
    {
        $dates = $this->overtimeService->getDate($request->date_ranger);
        $listCalendar =  $this->overtimeService->listCalendar();

        if ($request->register)
            return view('staff.over-time.index', [
                'infoRegister' => $this->overtimeService->infoRegister($request->register),
                'times' => $this->getTime(),
                'dates' => $dates,
                'listCalendar' => $listCalendar,
            ]);

        return view('staff.over-time.index', [
            'times' => $this->getTime(),
            'dates' => $dates,
            'listCalendar' => $listCalendar,
        ]);
    }

    public function getTime()
    {
        $user = auth()->user();
        $startTimeWorking = Carbon::parse($user->start_time_working)->subMinute(30);
        $endTimeWorking = Carbon::parse($user->end_time_working)->addMinute(30);
        $times = [];

        for ($i = 0; $i < 24; $i++) {
            $hour = $i < 10 ? '0' . $i : $i;

            if ($startTimeWorking->format('H') >= $hour) {
                $timeCheck = true;

                if (($startTimeWorking->format('H') == $hour && $startTimeWorking->format('i') == '00')) {
                    $timeCheck = false;
                }

                $times['start'][] = [
                    'hour' => $hour,
                    'minutes' => [
                        '00' => '00',
                        '30' => $timeCheck ? '30' : false,
                    ],
                ];
            }

            if ($endTimeWorking->format('H') <= $hour) {
                $timeCheck = true;

                if (($endTimeWorking->format('H') == $hour && $endTimeWorking->format('i') == '30')) {
                    $timeCheck = false;
                }

                $times['end'][] = [
                    'hour' => $hour,
                    'minutes' => [
                        '00' => $timeCheck ? '00' : false,
                        '30' => '30',
                    ],
                ];
            }
        }

        return $times;
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $startTimeWorking = Carbon::parse($request->start_time_working)->format('H:i');
            $endTimeWorking = Carbon::parse($request->end_time_working)->format('H:i');
            $message = __('common.create.success');

            $data = [
                'user_id' => $user->id,
                'date' => $request->date,
                'start_time_working' => $startTimeWorking,
                'end_time_working' => $endTimeWorking,
            ];

            if ($request->start_time != $startTimeWorking)
                $data['start_time'] = $request->start_time;

            if ($request->end_time != $endTimeWorking)
                $data['end_time'] = $request->end_time;

            if ($request->id) {
                $data['id'] = $request->id;

                $message = __('common.update.success');
            }

            $this->overtimeService->registerOverTime($data);

            return redirect()->route('staff-over-time.index')->with('success', $message);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Request $request, $type)
    {
        try {
            $listRegister = $this->overtimeService->listRegister($request->date);
            $dates = $this->overtimeService->getDate($request->date);

            return response()->json([
                'data' => $listRegister,
                'dates' => $dates,
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        $infoRegister = $this->overtimeService->infoRegisterByDate($request->date);

        return response()->json($infoRegister);
    }

    public function destroy($id)
    {
        try {
            $this->overtimeService->delete($id);

            return redirect()->route('staff-over-time.index')->with('success', __('common.delete.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
