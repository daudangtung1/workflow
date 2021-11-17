<?php

namespace App\Services\Staff;

use App\Services\BaseService;
use App\Models\OvertimeRegister;
use Carbon\Carbon;

class OverTimeService extends BaseService
{
    public function __construct(OvertimeRegister $model)
    {
        $this->model = $model;
    }

    public function registerOverTime($data = [])
    {
        $user = auth()->user();
        //delete if change date
        $this->model
            ->where(['date' => $data['date'], 'user_id' => $user->id])
            ->delete();

        if (isset($data['id'])) {
            //delete old id
            $this->model->where('id', $data['id'])->delete();
        }
        
        return $this->model->create($data);
    }

    public function listRegister($date = '')
    {
        $dates = $this->getMonth($date);

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';
        
        $user = auth()->user();
        $startTimeWorking = $this->formatTime($user->start_time_working);
        $endTimeWorking = $this->formatTime($user->end_time_working);

        $listRegister = $this->model
            ->whereBetween('date', [$from, $to])
            ->where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        $data = [];

        foreach ($listRegister as $item) {
            $beStart = $item->start_time ? (strtotime($startTimeWorking) - strtotime($item->start_time)) / 60 / 60 : 0;
            $afEnd = $item->end_time ? (strtotime($item->end_time) - strtotime($endTimeWorking)) / 60 / 60 : 0;

            $data[] = [
                'id' => $item->id,
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time' => $item->start_time ? $this->formatTime($item->start_time) : '-',
                'end_time' => $item->end_time ? $this->formatTime($item->end_time) : '-',
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->first_name . $item->userApprover->last_name : '',
                'time' => $beStart + $afEnd,
                'disable' => $item->approver ? true : false,
            ];
        }

        return $data;
    }

    public function infoRegister($id)
    {
        $info = $this->model->find($id);

        if ($info) {
            // $user = auth()->user();
            // $startTimeWorking = $this->formatTime($user->start_time_working);
            // $endTimeWorking = $this->formatTime($user->end_time_working);
            // $beStart = $info->start_time ? (strtotime($startTimeWorking) - strtotime($info->start_time)) / 60 / 60 : 0;
            // $afEnd = $info->end_time ? (strtotime($info->end_time) - strtotime($endTimeWorking)) / 60 / 60 : 0;

            return [
                'id' => $info->id,
                'date' => $info->date,
                'disable' => $info->approver ? true : false,
            ];
        }
    }

    public function infoRegisterByDate($date = '')
    {
        $user = auth()->user();
        $info = $this->model->where(['date' => $date, 'user_id' => $user->id])->first();

        if ($info) {
            $startTimeWorking = $this->formatTime($user->start_time_working);
            $endTimeWorking = $this->formatTime($user->end_time_working);
            $beStart = $info->start_time ? (strtotime($startTimeWorking) - strtotime($info->start_time)) / 60 / 60 : 0;
            $afEnd = $info->end_time ? (strtotime($info->end_time) - strtotime($endTimeWorking)) / 60 / 60 : 0;

            return [
                'id' => $info->id,
                'date' => $info->date,
                'start_time' => $this->formatTime($info->start_time),
                'end_time' => $this->formatTime($info->end_time),
                'before_start' => $beStart,
                'after_end' => $afEnd,
                'total' => $beStart + $afEnd,
                'disable' => $info->approver ? true : false,
            ];
        }
    }

    public function getDate($date = '')
    {
        try {
            if (!$date) $date  = Carbon::now()->toDateString();

            return $this->getMonth($date);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
