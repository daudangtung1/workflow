<?php

namespace App\Services\Manager;

use App\Enums\ApproverStatus;
use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Enums\VacationType;
use App\Models\Branch;
use App\Models\Calendar;
use App\Models\User;
use App\Models\Vacation;
use App\Services\BaseService;

class VacationService extends BaseService
{
    protected $branchModel;
    protected $userModel;
    protected $calendarModel;

    public function __construct(Vacation $vacationModel, Branch $branchModel, User $userModel, Calendar $calendarModel)
    {
        $this->branchModel = $branchModel;
        $this->userModel = $userModel;
        $this->model = $vacationModel;
        $this->calendarModel = $calendarModel;
    }

    public function listBranch()
    {
        return $this->branchModel->all();
    }

    public function listUser($role = '')
    {
        return $this->userModel->where('role', $role)->when($role == UserRole::STAFF, function ($q) {
            $q->orWhere('role', UserRole::APPROVER);
            $q->orWhere('role', UserRole::MANAGER);
        })->orderBy('created_at', 'DESC')->get();
    }

    public function listVacation($request)
    {
        $listVacation = $this->model
            //from and to
            ->when($request->start_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetWeen('start_date', [$request->start_date, $request->end_date]);
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
            ->when($request->manager_status && $request->manager_status != 'all', function ($query) use ($request) {
                if ($request->manager_status ==  ManagerStatus::PROCESSED)
                    return $query->whereNotNull('manager_confirm');

                return $query->whereNull('manager_confirm');
            })
            ->orderBy('start_date', 'DESC')
            ->get();

        $data = [];

        foreach ($listVacation as $item) {
            $user = $this->userModel->find($item->user_id);

            $data[] = [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'user' => $user ? $user->fullName : '',
                'start_date_register' => $item->start_date,
                'end_date_register' => $item->end_date,
                'start_date' => $item->start_date ? $item->start_date . '(' . $this->getDayOfWeek($item->start_date) . ')' : '',
                'end_date' => $item->end_date ? $item->end_date . '(' . $this->getDayOfWeek($item->end_date) . ')' : '',
                'reason' => $item->reason,
                'type_name' => VacationType::getDescription($item->type),
                'type' => $item->type,
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->first_name . $item->userApprover->last_name : '',
                'approver_id' => $item->approver,
                'manager_confirm' => $item->manager_confirm ? ManagerStatus::PROCESSED : false,
                'branch' => $user->branch ? $user->branch->name : '',
            ];
        }

        return $data;
    }

    public function updateVacation($arrId = [])
    {
        foreach ($arrId as $item) {
            $this->model->where('id', $item)->update([
                'manager_confirm' => auth()->user()->id,
            ]);
        }
    }

    public function updateInfoVacation($param)
    {
        $id = $param['id'];
        unset($param['id']);

        return $this->model->where('id', $id)->update($param);
    }

    public function deleteVacation($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function listCalendar()
    {
        return $this->calendarModel->get();
    }
}
