<?php

namespace App\Services\Staff;

use App\Enums\VacationType;
use App\Services\BaseService;
use App\Models\Vacation;
use Carbon\Carbon;

class VacationService extends BaseService
{
    public function __construct(Vacation $model)
    {
        $this->model = $model;
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
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->first_name . $item->userApprover->last_name : '',
                'disable' => $item->approver ? true : false,
            ];
        }

        return $data;
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
        ];

        return $data;
    }
}
