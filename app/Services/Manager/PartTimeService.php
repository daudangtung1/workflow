<?php

namespace App\Services\Manager;

use App\Enums\ApproverStatus;
use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Models\Branch;
use App\Models\ParttimeRegister;
use App\Models\User;
use App\Services\BaseService;
use App\Models\Calendar;


class PartTimeService extends BaseService
{
    protected $branchModel;
    protected $userModel;

    public function __construct(ParttimeRegister $partTimeModel, Branch $branchModel, User $userModel)
    {
        $this->branchModel = $branchModel;
        $this->userModel = $userModel;
        $this->model = $partTimeModel;
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

    public function listPartTime($request)
    {
        $listPartTime = $this->model
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
            ->when($request->manager_status && $request->manager_status != 'all', function ($query) use ($request) {
                if ($request->manager_status ==  ManagerStatus::PROCESSED)
                    return $query->whereNotNull('manager_confirm');

                return $query->whereNull('manager_confirm');
            })
            ->orderBy('date', 'DESC')
            ->get();

        $data = [];

        foreach ($listPartTime as $item) {
            $time1 =  $item->start_time_first ? (strtotime($item->end_time_first) - strtotime($item->start_time_first)) / 60  : 0;
            $time2 =  $item->start_time_second ? (strtotime($item->end_time_second) - strtotime($item->start_time_second)) / 60  : 0;
            $time3 = $item->start_time_third ? (strtotime($item->end_time_third) - strtotime($item->start_time_third)) / 60  : 0;
            $user = $this->userModel->find($item->user_id);

            $data[] = [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'user' => $user ? $user->fullName : '',
                'date_register' => $item->date,
                'date' => $item->date ? $item->date . '(' . $this->getDayOfWeek($item->date) . ')' : '',

                'start_time1' => $item->start_time_first ? $this->formatTime($item->start_time_first) : '-',
                'end_time1' => $item->end_time_first ? $this->formatTime($item->end_time_first) : '-',
                'start_time2' => $item->start_time_second ? $this->formatTime($item->start_time_second) : '-',
                'end_time2' => $item->end_time_second ? $this->formatTime($item->end_time_second) : '-',
                'start_time3' => $item->start_time_third ? $this->formatTime($item->start_time_third) : '-',
                'end_time3' => $item->end_time_third ? $this->formatTime($item->end_time_third) : '-',
                'time' => $time1 + $time2 + $time3,

                'approval_date' => $item->approval_date ? $this->formatTime($item->approval_date, 'datetime') : '',
                'approver' => $item->userApprover ? $item->userApprover->first_name . $item->userApprover->last_name : '',
                'approver_id' => $item->approver,
                'manager_confirm' => $item->manager_confirm ? ManagerStatus::PROCESSED : false,
                'branch' => $user->branch ? $user->branch->name : '',
            ];
        }

        return $data;
    }

    public function updatePartTime($arrId = [])
    {
        foreach ($arrId as $item) {
            $this->model->where('id', $item)->update([
                'manager_confirm' => auth()->user()->id,
            ]);
        }
    }

    public function updateInfoPartTime($param)
    {
        $id = $param['id'];
        unset($param['id']);

        return $this->model->where('id', $id)->update($param);
    }

    public function deletePartTime($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function listCalendarFull()
    {
        $list=Calendar::all();
        $data=[];
        foreach($list as $item){
            $data[]=[
                'date'=>$item->date . '('. $this->getDayOfWeek($item->date) . ')',
            ];
        }
        return $data;
    }
}
