<?php

namespace App\Services\Staff;

use App\Enums\AbsenceOption;
use App\Models\Absence;
use App\Services\BaseService;

class AbsenceService extends BaseService
{
    public function __construct(Absence $model)
    {
        $this->model = $model;
    }

    public function createAbsence($data = [])
    {
        return $this->model->create($data);
    }

    public function listAbsence()
    {
        $user = auth()->user();

        $listAbsence = $this->model->where('user_id', $user->id)->orderBy('date', 'ASC')->get();
        $data = [];

        foreach ($listAbsence as $item) {
            $data[] = [
                'id' => $item->id,
                'date' => $item->date ? $item->date . '(' . $this->getDayOfWeek($item->start_date) . ')' : '',
                'reason' => $item->reason,
                'option' => $item->option,
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->fullName: '',
                'disable' => $item->approver ? true : false,
            ];
        }

        return $data;
    }

    public function updateAbsence($data = [], $id)
    {
        return $this->model->where('id', $id)->update($data);
    }
}
