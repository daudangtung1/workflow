<?php

namespace App\Services\Manager;

use App\Enums\AbsenceOption;
use App\Enums\ApproverStatus;
use App\Enums\ManagerStatus;
use App\Models\Absence;
use App\Models\Branch;
use App\Models\User;
use App\Services\BaseService;


class AbsenceService extends BaseService
{
    protected $branchModel;
    protected $userModel;

    public function __construct(Absence $absenceModel, Branch $branchModel, User $userModel)
    {
        $this->branchModel = $branchModel;
        $this->userModel = $userModel;
        $this->model = $absenceModel;
    }

    public function listBranch()
    {
        return $this->branchModel->all();
    }

    public function listUser($role)
    {
        return $this->userModel->where('role', $role)->orderBy('created_at', 'DESC')->get();
    }

    public function listAbsence($request)
    {
        $listAbsence = $this->model
            //from and to
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetWeen('date', [$request->start_date, $request->end_date]);
            })
            //user_id
            ->when($request->staff, function ($query) use ($request) {
                $query->where('user_id', [$request->staff]);
            })
            //first name or last name
            ->when($request->name, function ($query) use ($request) {
                $query->whereHas('user', function ($subQuery) use ($request) {
                    $subQuery->where('first_name', 'like', '%' . $request->name . '%')
                        ->orWhere('last_name', 'like', '%' . $request->name . '%');
                });
            })
            //branch
            ->when($request->branch_id, function ($query) use ($request) {
                $query->whereHas('user', function ($subQuery) use ($request) {
                    $subQuery->where('branch_id', $request->branch_id);
                });
            })
            //approver status
            ->when($request->approver_status, function ($query) use ($request) {
                if ($request->approver_status ==  ApproverStatus::APPROVED)
                    return $query->whereNotNull('approver');

                return $query->whereNull('approver');
            })
            // manager status
            ->when($request->manager_status, function ($query) use ($request) {
                if ($request->manager_status ==  ManagerStatus::PROCESSED)
                    return $query->whereNotNull('manager_confirm');

                return $query->whereNull('manager_confirm');
            })
            ->orderBy('date', 'DESC')
            ->get();

        $data = [];

        foreach ($listAbsence as $item) {
            $user = $this->userModel->find($item->user_id);

            $data[] = [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'user' => $user ? $user->fullName : '',
                'date_register' => $item->date,
                'date' => $item->date ? $item->date . '(' . $this->getDayOfWeek($item->date) . ')' : '',
                'reason' => $item->reason,
                'option_name' => AbsenceOption::getDescription($item->option),
                'option' => $item->option,
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->first_name . $item->userApprover->last_name : '',
                'approver_id' => $item->approver,
                'manager_confirm' => $item->manager_confirm ? ManagerStatus::PROCESSED : false,
                'branch' => $user->branch ? $user->branch->name : '',
            ];
        }

        return $data;
    }

    public function updateAbsence($arrId = [])
    {
        foreach ($arrId as $item) {
            $this->model->where('id', $item)->update([
                'manager_confirm' => auth()->user()->id,
            ]);
        }
    }

    public function updateInfoAbsence($param)
    {
        $id = $param['id'];
        unset($param['id']);

        return $this->model->where('id', $id)->update($param);
    }

    public function deleteAbsence($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
