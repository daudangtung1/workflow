<?php

namespace App\Http\Controllers\Manager;

use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Manager\OverTimeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OverTimeController extends Controller
{
    protected $overTimeService;

    public function __construct(OverTimeService $overTimeService)
    {
        $this->overTimeService = $overTimeService;
    }

    public function index()
    {
        return view('manager.over-time.index', [
            'staffs' => $this->overTimeService->listUser(UserRole::STAFF),
            'branchs' => $this->overTimeService->listBranch(),
            'active' => 'index',
            'times' => $this->getTime(),
            'approvers' => $this->overTimeService->listUser(UserRole::APPROVER),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'user_id' => $request->user_register,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'approver' => $request->approver,
                'approval_date' => $request->approval_date ? Carbon::parse($request->approval_date)->format('Y-m-d H:i:s') : null,
                'manager_confirm' => null,
                'id' => $request->id,
            ];

            if ($request->manager_status_edit == ManagerStatus::PROCESSED) {
                $data['manager_confirm'] = auth()->user()->id;
            }

            $this->overTimeService->registerOverTime($data);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function show(Request $request, $id)
    {
        $dataRegister = $this->overTimeService->listOverTime($request);

        return view('manager.over-time.index', [
            'staffs' => $this->overTimeService->listUser(UserRole::STAFF),
            'branchs' => $this->overTimeService->listBranch(),
            'active' => 'show',
            'dataRegister' =>  $dataRegister,
            'times' => $this->getTime(),
            'approvers' => $this->overTimeService->listUser(UserRole::APPROVER),
        ]);
    }

    public function edit(Request $request, $type)
    {
        if ($type == 'getTime')
            return response()->json($this->getTime($request->start_time_working, $request->end_time_working));

        $infoRegister = $this->overTimeService->infoRegisterByDate($request->id, $request->user);

        return response()->json($infoRegister);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->overTimeService->updateOverTime($request->id);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->overTimeService->deleteOverTime([
            'user_id' => $request->user_register,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', __('common.delete.success'));

    }

    public function getTime($startTimeWorking = '', $endTimeWorking = '')
    {
        // $user = auth()->user();
        $startTimeWorking = Carbon::parse($startTimeWorking);
        $endTimeWorking = Carbon::parse($endTimeWorking);
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
}
