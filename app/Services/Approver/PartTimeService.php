<?php

namespace App\Services\Approver;

use App\Models\ParttimeRegister;
use App\Services\BaseService;
use Carbon\Carbon;

class PartTimeService extends BaseService
{
    public function __construct(ParttimeRegister $model)
    {
        $this->model = $model;
    }

    public function listRegister($partTimes = [])
    {
        $data = [];

        foreach ($partTimes as $item) {
            $time1 =  $item->start_time_first ? (strtotime($item->end_time_first) - strtotime($item->start_time_first)) / 60 : 0;
            $time2 =  $item->start_time_second ? (strtotime($item->end_time_second) - strtotime($item->start_time_second)) / 60 : 0;
            $time3 = $item->start_time_third ? (strtotime($item->end_time_third) - strtotime($item->start_time_third)) / 60 : 0;

            $data[] = [
                'id' => $item->id,
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time1' => $item->start_time_first ? $this->formatTime($item->start_time_first) : '-',
                'end_time1' => $item->end_time_first ? $this->formatTime($item->end_time_first) : '-',
                'start_time2' => $item->start_time_second ? $this->formatTime($item->start_time_second) : '-',
                'end_time2' => $item->end_time_second ? $this->formatTime($item->end_time_second) : '-',
                'start_time3' => $item->start_time_third ? $this->formatTime($item->start_time_third) : '-',
                'end_time3' => $item->end_time_third ? $this->formatTime($item->end_time_third) : '-',
                'time' => $time1 + $time2 + $time3,
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
