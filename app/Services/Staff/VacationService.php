<?php

namespace App\Services\Staff;

use App\Enums\VacationType;
use App\Models\Calendar;
use App\Services\BaseService;
use App\Models\Vacation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VacationService extends BaseService
{
    public function __construct(Vacation $model, Calendar $calendarModel)
    {
        $this->model = $model;
        $this->calendarModel = $calendarModel;
    }

    public function createVacation($data = [])
    {
        return $this->model->create($data);
    }

    public function updateVacation($data = [], $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function listVacation()
    {
        $user = auth()->user();
        $listVacation = $this->model->where('user_id', $user->id)->orderBy('start_date', 'DESC')->get();
        $data = [];

        foreach ($listVacation as $item) {
            $data[] = [
                'id' => $item->id,
                'start_date' => $item->start_date ? $item->start_date . '(' . $this->getDayOfWeek($item->start_date) . ')' : '',
                'end_date' => $item->end_date ? $item->end_date . '(' . $this->getDayOfWeek($item->end_date) . ')' : '',
                'reason' => $item->reason,
                'type' => VacationType::getDescription($item->type),
                'type_id' => $item->type,
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->fullName : '',
                'disable' => $item->approver ? true : false,
                'total_time' => $item->total_time ? $item->total_time : null,
            ];
        }

        return $data;
    }

    public function listYear()
    {
        $listYear=Vacation::select(DB::raw('SUBSTR(start_date, 1, 4) as year'))->groupBy('year')->orderBy('year', 'DESC')->pluck('year')->toArray();
        if (!in_array(Carbon::now()->year, $listYear)) {
            array_push($listYear, Carbon::now()->year);
        }

        sort($listYear);
        return $listYear;
    }

    public function infoVacation($id = '')
    {
        $info = $this->model->findOrFail($id);

        $data = [
            'id' => $info->id,
            'start_date' => $info->start_date,
            'end_date' => $info->end_date,
            'reason' => $info->reason,
            'type' => $info->type,
            'disable' => $info->approver ? true : false,
            'start_time_1' => $info->start_time_1,
            'end_time_1' => $info->end_time_1,
            'start_time_2' => $info->start_time_2,
            'end_time_2' => $info->end_time_2,
            'total_time' => $info->total_time,
        ];

        return $data;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
