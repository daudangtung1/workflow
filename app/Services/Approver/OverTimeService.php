<?php

namespace App\Services\Approver;

use App\Models\OvertimeRegister;
use App\Services\BaseService;
use Carbon\Carbon;

class OverTimeService extends BaseService
{
    public function __construct(OvertimeRegister $model)
    {
        $this->model = $model;
    }

    public function listRegister($overtimes = [])
    {
        $data = [];

        foreach ($overtimes as $item) {
            $startTimeWorking = $this->formatTime($item->user->start_time_working);
            $endTimeWorking = $this->formatTime($item->user->end_time_working);

            $beStart = $item->start_time ? (strtotime($startTimeWorking) - strtotime($item->start_time)) / 60 : 0;
            $afEnd = $item->end_time ? (strtotime($item->end_time) - strtotime($endTimeWorking)) / 60 : 0;

            $data[] = [
                'id' => $item->id,
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time' => $item->start_time ? $this->formatTime($item->start_time) : '-',
                'end_time' => $item->end_time ? $this->formatTime($item->end_time) : '-',
                'time' => $beStart + $afEnd,
                'user' => $item->user->fullName . ' (' . $item->user->user_id . ')',
            ];
        }

        return $data;
    }

    public function updateApprover($arrId = [])
    {
        foreach ($arrId as $item) {
            $this->model->where('id', $item)->update([
                'approval_date' => Carbon::now(),
                'approver' => auth()->user()->id,
            ]);
        }
    }
}