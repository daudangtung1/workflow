<?php

namespace App\Http\Controllers\Manager;

use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Manager\PartTimeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PartTimeController extends Controller
{
    protected $partTimeService;

    public function __construct(PartTimeService $partTimeService)
    {
        $this->partTimeService = $partTimeService;
    }

    public function index()
    {
        return view('manager.part-time.index', [
            'staffs' => $this->partTimeService->listUser(UserRole::STAFF),
            'branchs' => $this->partTimeService->listBranch(),
            'active' => 'index',
            'times' => $this->getTime(),
            'approvers' => $this->partTimeService->listUser(UserRole::APPROVER),
            'listCalendar' =>  $this->partTimeService->listCalendarFull(),
        ]);
    }

    public function show(Request $request)
    {
        $dataPartTime = $this->partTimeService->listPartTime($request);
        $listCalendarData = $this->partTimeService->listCalendarFull();

        return view('manager.part-time.index', [
            'staffs' => $this->partTimeService->listUser(UserRole::STAFF),
            'branchs' => $this->partTimeService->listBranch(),
            'active' => 'show',
            'times' => $this->getTime(),
            'dataPartTime' => $dataPartTime,
            'approvers' => $this->partTimeService->listUser(UserRole::APPROVER),
            'listCalendar' =>  $this->partTimeService->listCalendar(),
        ], compact('listCalendarData'));
    }

    public function update(Request $request, $type)
    {
        try {
            $this->partTimeService->updatePartTime($request->id);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateInfo(Request $request, $type)
    {
        try {
            $data = [
                'user_id' => $request->user_register,
                'date' => substr($request->date, 0, -6),
                'approver' => $request->approver,
                'approval_date' => $request->approval_date ? Carbon::parse(substr($request->approval_date, 0, -6))->format('Y-m-d H:i:s') : null,
                'manager_confirm' => null,
                'id' => $request->id,
            ];

            if ($request->manager_status_edit == ManagerStatus::PROCESSED) {
                $data['manager_confirm'] = auth()->user()->id;
            }

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

            $this->partTimeService->updateInfoPartTime($data);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->partTimeService->deletePartTime($request->id);

        return redirect()->back()->with('success', __('common.delete.success'));

    }

    public function getTime()
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

        return $times;
    }

}
