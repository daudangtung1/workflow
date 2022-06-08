<?php

namespace App\Services\ApproverMonth;

use App\Models\OvertimeRegister;
use App\Services\BaseService;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Enums\UserRole;
use App\Enums\ApproverStatus;
use App\Models\Calendar;

class OverTimeService extends BaseService
{
    public function __construct(OvertimeRegister $overtimeRegister, Branch $branchModel, User $userModel)
    {
        $this->branchModel = $branchModel;
        $this->userModel = $userModel;
        $this->model = $overtimeRegister;
    }

    public function listRegister($overtimes = [])
    {
        $data = [];

        foreach ($overtimes as $item) {
            $startTimeWorking = $this->formatTime($item->user->start_time_working);
            $endTimeWorking = $this->formatTime($item->user->end_time_working);

            $beStart = $item->start_time ? (strtotime($startTimeWorking) - strtotime($item->start_time)) / 60 : 0;
            $afEnd = $item->end_time ? (strtotime($item->end_time) - strtotime($endTimeWorking)) / 60 : 0;

            $data[] = [
                'id' => $item->id,
                'date' => $item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
                'start_time' => $item->start_time ? $this->formatTime($item->start_time) : '-',
                'end_time' => $item->end_time ? $this->formatTime($item->end_time) : '-',
                'time' => $beStart + $afEnd,
                'user' => $item->user->fullName . ' (' . $item->user->user_id . ')',
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
            // ->when($request->name, function ($query) use ($request) {
            //     $query->whereHas('user', function ($subQuery) use ($request) {
            //         $subQuery->where('first_name', 'like', '%' . $request->name . '%')
            //             ->orWhere('last_name', 'like', '%' . $request->name . '%');
            //     });
            // })
            //branch
            ->when($request->branch_id, function ($query) use ($request) {
                $query->whereHas('user', function ($subQuery) use ($request) {
                    $subQuery->where('branch_id', $request->branch_id);
                });
            })
            //approver status
            ->when($request->approver_status, function ($query) use ($request) {
                if ($request->approver_status ==  ApproverStatus::APPROVED) return $query->whereNotNull('approver');
                elseif ($request->approver_status ==  ApproverStatus::PENDING) return $query->whereNull('approver');
                elseif ($request->approver_status ==  ApproverStatus::ALL) return $query->whereNull('approver');
            })
            // manager status
            // ->when($request->manager_status != 'all' && $request->manager_status, function ($query) use ($request) {
            //     if ($request->manager_status ==  ManagerStatus::PROCESSED)
            //         return $query->whereNotNull('manager_confirm');

            //     return $query->whereNull('manager_confirm');
            // })
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

    public function listUser($role = '')
    {
        return $this->userModel->where('role', $role)->when($role == UserRole::STAFF, function ($q) {
            $q->orWhere('role', UserRole::APPROVER);
            $q->orWhere('role', UserRole::MANAGER);
        })->orderBy('created_at', 'DESC')->get();
    }

    public function listBranch()
    {
        return $this->branchModel->all();
    }

    public function listCalendarFull()
    {
        $list=Calendar::all();
        
        $data_1=[];
        foreach($list as $item){
            $data_1[]=[
                'date'=>$item->date . ' (' . $this->getDayOfWeek($item->date) . ')',
            ];
        }
        $data=[];
        foreach($data_1 as $d){
            foreach ($d as $e)
                $data[]=$e;
        }
        return $data;
    }
}
