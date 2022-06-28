<?php

namespace App\Services\Staff;

use App\Services\BaseService;
use App\Models\ParttimeRegister;
use Carbon\Carbon;
use App\Models\Calendar;

class PartTimeService extends BaseService
{
    public function __construct(ParttimeRegister $model)
    {
        $this->model = $model;
    }

    public function registerPartTime($data = [])
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
            ->orderBy('date', 'desc')
            ->get();

        $callback = [
            'id' => '',
            'date' => '',
            'start_time1' => '-',
            'end_time1' => '-',
            'start_time2' => '-',
            'end_time2' => '-',
            'start_time3' => '-',
            'end_time3' => '-',
            'approval_date' => '',
            'approver' => '',
            'time' => '',
            'disable' => false,
        ];

        $data = $this->scopeDate($from, $to, $callback);
        // $data = [];

        foreach ($listRegister as $item) {
            $time1 =  $item->start_time_first ? (strtotime($item->end_time_first) - strtotime($item->start_time_first)) / 60  : 0;
            $time2 =  $item->start_time_second ? (strtotime($item->end_time_second) - strtotime($item->start_time_second)) / 60  : 0;
            $time3 = $item->start_time_third ? (strtotime($item->end_time_third) - strtotime($item->start_time_third)) / 60  : 0;

            $data[$item->date] = [
                'id' => $item->id,
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time1' => $item->start_time_first ? $this->formatTime($item->start_time_first) : '-',
                'end_time1' => $item->end_time_first ? $this->formatTime($item->end_time_first) : '-',
                'start_time2' => $item->start_time_second ? $this->formatTime($item->start_time_second) : '-',
                'end_time2' => $item->end_time_second ? $this->formatTime($item->end_time_second) : '-',
                'start_time3' => $item->start_time_third ? $this->formatTime($item->start_time_third) : '-',
                'end_time3' => $item->end_time_third ? $this->formatTime($item->end_time_third) : '-',
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'monthdate') : '',
                'approver' => $item->userApprover ? $item->userApprover->fullName : '',
                'time' => $time1 + $time2 + $time3,
                'disable' => $item->approver ? true : false,
                'date_id' => $item->date ? $item->date : '',
            ];
        }

        return $data;
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

    public function infoRegister($id)
    {
        $info = $this->model->find($id);

        if ($info)
            return [
                'id' => $info->id,
                'date' => $info->date,
                'disable' => $info->approver ? true : false,
            ];
    }

    public function infoRegisterByDate($date = '')
    {
        $user = auth()->user();
        $info = $this->model->where(['date' => $date, 'user_id' => $user->id])->first();

        if ($info) {
            $time1 =  $info->start_time_first ? (strtotime($info->end_time_first) - strtotime($info->start_time_first)) / 60  : 0;
            $time2 =  $info->start_time_second ? (strtotime($info->end_time_second) - strtotime($info->start_time_second)) / 60  : 0;
            $time3 = $info->start_time_third ? (strtotime($info->end_time_third) - strtotime($info->start_time_third)) / 60  : 0;

            return [
                'id' => $info->id,
                'date' => $info->date,
                'start_time_first' => $this->formatTime($info->start_time_first),
                'end_time_first' => $this->formatTime($info->end_time_first),
                'start_time_second' => $this->formatTime($info->start_time_second),
                'end_time_second' => $this->formatTime($info->end_time_second),
                'start_time_third' => $this->formatTime($info->start_time_third),
                'end_time_third' => $this->formatTime($info->end_time_third),
                'total' => $time1 + $time2 + $time3,
                'disable' => $info->approver ? true : false,
            ];
        }
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function listCalendar()
    {
        return Calendar::all();
    }
}
