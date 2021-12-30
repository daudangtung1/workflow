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


        $listRegister = $this->model
            ->whereBetween('date', [$from, $to])
            ->where('user_id', $user->id)
            ->orderBy('date', 'asc')
            ->get();

        $data = [];
        $callback = [
            'id' => '',
            'date' => '',
            'start_time' => '-',
            'end_time' =>  '-',
            'approval_date' => '',
            'approver' => '',
            'time' => '',
            'disable' => false,
        ];

        $data = $this->scopeDate($from, $to, $callback);

        foreach ($listRegister as $item) {
            $startTimeWorking = $this->formatTime($item->start_time_working);
            $endTimeWorking = $this->formatTime($item->end_time_working);

            $beStart = $item->start_time ? (strtotime($startTimeWorking) - strtotime($item->start_time)) / 60  : 0;
            $afEnd = $item->end_time ? (strtotime($item->end_time) - strtotime($endTimeWorking)) / 60  : 0;

            $data[$item->date] = [
                'id' => $item->id,
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time' => $item->start_time ? $this->formatTime($item->start_time) : '-',
                'end_time' => $item->end_time ? $this->formatTime($item->end_time) : '-',
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->fullName : '',
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
            $startTimeWorking = $this->formatTime($info->start_time_working);
            $endTimeWorking = $this->formatTime($info->end_time_working);
            
            return [
                'id' => $info->id,
                'date' => $info->date,
                'disable' => $info->approver ? true : false,
                'start_time_working' => $startTimeWorking,
                'end_time_working' => $endTimeWorking,
            ];
        }
    }

    public function infoRegisterByDate($date = '')
    {
        $user = auth()->user();
        $info = $this->model->where(['date' => $date, 'user_id' => $user->id])->first();

        if ($info) {
            $startTimeWorking = $this->formatTime($info->start_time_working);
            $endTimeWorking = $this->formatTime($info->end_time_working);
            $beStart = $info->start_time ? (strtotime($startTimeWorking) - strtotime($info->start_time)) / 60  : 0;
            $afEnd = $info->end_time ? (strtotime($info->end_time) - strtotime($endTimeWorking)) / 60  : 0;

            return [
                'id' => $info->id,
                'date' => $info->date,
                'start_time' => $this->formatTime($info->start_time),
                'end_time' => $this->formatTime($info->end_time),
                'before_start' => $beStart,
                'after_end' => $afEnd,
                'start_time_working' => $startTimeWorking,
                'end_time_working' => $endTimeWorking,
                'total' => $beStart + $afEnd,
                'disable' => $info->approver ? true : false,
                'time' => $this->getTime($info->start_time_working, $info->end_time_working),
            ];
        }

        return [
            'time' => $this->getTime(),
        ];
    }

    public function getDate($date = '')
    {
        try {
            if (!$date) {
                $date = Carbon::now()->format('Y-m');
                //if datenow < 11 -1 month
                $dayNow = Carbon::now()->format('d');

                if ($dayNow <= '10')
                    $date = Carbon::now()->subMonth()->format('Y-m');
            }

            return $this->getMonth($date);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function getTime($startTimeWorking = '', $endTimeWorking = '')
    {
        $user = auth()->user();
        $startTimeWorking = $startTimeWorking ? Carbon::parse($startTimeWorking) : Carbon::parse($user->start_time_working) ;
        $endTimeWorking = $endTimeWorking ? Carbon::parse($endTimeWorking) :  Carbon::parse($user->end_time_working);
        $startTimeWorking->subMinute(30);
        $endTimeWorking->addMinute(30);
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

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

}
