<?php

namespace App\Services\Approver;

use App\Enums\AbsenceOption;
use App\Models\Absence;
use App\Services\BaseService;
use Carbon\Carbon;

class AbsenceService extends BaseService
{
    public function __construct(Absence $model)
    {
        $this->model = $model;
    }

    public function listAbsence($absences = [])
    {
        $data = [];

        foreach ($absences as $item) {
            $data[] = [
                'id' => $item->id,
                'date' => $item->date ? $item->date . '(' . $this->getDayOfWeek($item->date) . ')' : '',
                'reason' => $item->reason,
                'option' => $item->option,
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
