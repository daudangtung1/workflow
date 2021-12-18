<?php

namespace App\Services\Approver;

use App\Enums\VacationType;
use App\Models\Vacation;
use App\Services\BaseService;
use Carbon\Carbon;

class VacationService extends BaseService
{
    public function __construct(Vacation $model)
    {
        $this->model = $model;
    }

    public function listVacation($vacations = [])
    {
        $data = [];

        foreach ($vacations as $item) {
            $data[] = [
                'id' => $item->id,
                'start_date' => $item->start_date ? $item->start_date . '(' . $this->getDayOfWeek($item->start_date) . ')' : '',
                'end_date' => $item->end_date ? $item->end_date . '(' . $this->getDayOfWeek($item->end_date) . ')' : '',
                'reason' => $item->reason,
                'type' => VacationType::getDescription($item->type),
                'type_id' => $item->type,
                'user' => $item->user->fullName. ' (' . $item->user->user_id . ')',
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
