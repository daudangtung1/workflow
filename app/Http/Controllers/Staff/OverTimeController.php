<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Staff\OvertimeService;

class OverTimeController extends Controller
{
    protected $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function index(Request $request)
    {
        if ($request->register)
            return view('staff.over-time.index', [
                'infoRegister' => $this->overtimeService->infoRegister($request->register)
            ]);

        return view('staff.over-time.index');
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $startTimeWorking = Carbon::parse($user->start_time_working)->format('H:i');
            $endTimeWorking = Carbon::parse($user->end_time_working)->format('H:i');

            $data = [
                'user_id' => $user->id,
                'date' => $request->date,
            ];

            if ($request->start_time != $startTimeWorking)
                $data['start_time'] = $request->start_time;

            if ($request->end_time != $endTimeWorking)
                $data['end_time'] = $request->end_time;

            if ($request->id)
                $data['id'] = $request->id;


            $this->overtimeService->registerOverTime($data);

            return redirect()->route('staff.over-time.index')->with('success', __('common.message.success_create'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function show(Request $request, $type)
    {
        try {
            $listRegister = $this->overtimeService->listRegister($request->from, $request->to);

            return response()->json($listRegister);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        $infoRegister = $this->overtimeService->infoRegisterByDate($request->date);

        return response()->json($infoRegister);
    }
}
