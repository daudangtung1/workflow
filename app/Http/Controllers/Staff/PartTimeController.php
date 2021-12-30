<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Services\Staff\PartTimeService;
use Illuminate\Http\Request;

class PartTimeController extends Controller
{
    protected $parttimeService;

    public function __construct(PartTimeService $parttimeService)
    {
        $this->parttimeService = $parttimeService;
    }

    public function index(Request $request)
    {
        $times = [];

        for ($i = 0; $i < 24; $i++) {
            $times[] = [
                'hour' => $i < 10 ? '0' . $i : $i,
                'minutes' => [
                    '00' => "00",
                    '30' => '30',
                ],
            ];
        }

        $dates = $this->parttimeService->getDate($request->date_ranger);

        //form edit
        if ($request->register)
            return view('staff.part-time.index', [
                'infoRegister' => $this->parttimeService->infoRegister($request->register),
                'times' => $times,
                'dates' => $dates,
                'listCalendar' =>  $this->parttimeService->listCalendar(),
            ]);

        return view('staff.part-time.index', [
            'times' => $times,
            'dates' => $dates,
            'listCalendar' =>  $this->parttimeService->listCalendar(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $data = [
                'user_id' => $user->id,
                'date' => $request->date,
            ];
            $message = __('common.create.success');

            if ($request->start_time_first < $request->end_time_first) {
                $data['start_time_first'] = $request->start_time_first;
                $data['end_time_first'] = $request->end_time_first;
            }

            if ($request->start_time_second < $request->end_time_second) {
                $data['start_time_second'] = $request->start_time_second;
                $data['end_time_second'] = $request->end_time_second;
            }

            if ($request->start_time_third < $request->end_time_third) {
                $data['start_time_third'] = $request->start_time_third;
                $data['end_time_third'] = $request->end_time_third;
            }

            if ($request->id) {
                $data['id'] = $request->id;
                $message = __('common.update.success');
            }

            $this->parttimeService->registerPartTime($data);

            return redirect()->route('staff-part-time.index')->with('success', $message);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $listRegister = $this->parttimeService->listRegister($request->date);
            $dates = $this->parttimeService->getDate($request->date);

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
        $infoRegister = $this->parttimeService->infoRegisterByDate($request->date);

        return response()->json($infoRegister);
    }

    public function destroy($id)
    {
        try {
            $this->parttimeService->delete($id);

            return redirect()->route('staff-part-time.index')->with('success', __('common.delete.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
