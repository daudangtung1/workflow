<?php

namespace App\Services\Manager;

use App\Enums\ApproverStatus;
use App\Enums\ManagerStatus;
use App\Models\Branch;
use App\Models\OvertimeRegister;
use App\Models\User;
use App\Services\BaseService;


class OverTimeService extends BaseService
{
    protected $branchModel;
    protected $userModel;

    public function __construct(OvertimeRegister $overtimeRegister, Branch $branchModel, User $userModel)
    {
        $this->branchModel = $branchModel;
        $this->userModel = $userModel;
        $this->model = $overtimeRegister;
    }

    public function listBranch()
    {
        return $this->branchModel->all();
    }

    public function listUser($role)
    {
        return $this->userModel->where('role', $role)->orderBy('created_at', 'DESC')->get();
    }

    public function listOverTime($request)
    {
        $listOverTime = $this->model
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
            ->when($request->manager_status != 'all' && $request->manager_status, function ($query) use ($request) {
                if ($request->manager_status ==  ManagerStatus::PROCESSED)
                    return $query->whereNotNull('manager_confirm');

                return $query->whereNull('manager_confirm');
            })
            ->orderBy('date', 'DESC')
            ->get();

        $data = [];

        foreach ($listOverTime as $item) {
            $startTimeWorking = $item->start_time_working ? $this->formatTime($item->start_time_working) : '';
            $endTimeWorking = $item->end_time_working ? $this->formatTime($item->end_time_working) : '';

            $beStart = $item->start_time ? (strtotime($startTimeWorking) - strtotime($item->start_time)) / 60 : 0;
            $afEnd = $item->end_time ? (strtotime($item->end_time) - strtotime($endTimeWorking)) / 60 : 0;

            $user = $this->userModel->find($item->user_id);

            $data[] = [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'date_register' => $item->date,
                'user' => $user ? $user->fullName : '-',
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time' => $item->start_time ? $this->formatTime($item->start_time) : '-',
                'end_time' => $item->end_time ? $this->formatTime($item->end_time) : '-',
                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '-',
                'approver' => $item->userApprover ? $item->userApprover->first_name . ' ' . $item->userApprover->last_name : '-',
                'time' => $beStart + $afEnd,
                'manager_confirm' => $item->manager_confirm ? true : false,
                'branch' => $user->branch ? $user->branch->name : '-',
                'start_time_working' => $startTimeWorking,
                'end_time_working' => $endTimeWorking,
            ];
        }

        return $data;
    }

    public function updateOverTime($arrId = [])
    {
        foreach ($arrId as $item) {
            $this->model->where('id', $item)->update([
                'manager_confirm' => auth()->user()->id,
            ]);
        }
    }

    public function infoRegisterByDate($id, $userId)
    {
        $user = $this->userModel->find($userId);
        $info = $this->model->find($id);

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
                'approver' => $info->approver,
                'manager_confirm' => $info->manager_confirm ? ManagerStatus::PROCESSED : false,
                'approval_date' => $info->approval_date,
                'start_time_working' => $startTimeWorking,
                'end_time_working' => $endTimeWorking,
            ];
        }
    }

    public function registerOverTime($param)
    {
            $id = $param['id'];
            unset($param['id']);

            return $this->model->where('id', $id)->update($param);
    }
    // public function registerOverTime($param)
    // {
    //     if (isset($param['id'])) {
    //         $id = $param['id'];
    //         unset($param['id']);

    //         return $this->model->where('id', $id)->update($param);
    //     }

    //     $infoRegister = $this->model->where([
    //         'user_id' => $param['user_id'],
    //         'date' => $param['date'],
    //     ])->first();

    //     if ($infoRegister)
    //         return $this->model->where('id', $infoRegister->id)->update($param);

    //     return $this->model->create($param);
    // }

    public function deleteOverTime($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
