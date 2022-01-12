<?php

namespace App\Services\Manager;

use App\Enums\UserRole;
use App\Models\Branch;
use App\Models\WorkingPart;
use App\Models\User;
use App\Services\BaseService;

class StaffService extends BaseService
{
    protected $branchModel;
    protected $workingPartModel;
    protected $userModel;

    public function __construct(Branch $branchModel, WorkingPart $workingPartModel, User $userModel)
    {
        $this->branchModel = $branchModel;
        $this->workingPartModel = $workingPartModel;
        $this->userModel = $userModel;
    }

    public function createStaff($data = [])
    {
        return $this->userModel->create($data);
    }

    public function updateStaff($data = [], $id)
    {
        return $this->userModel->where('id', $id)->update($data);
    }

    public function listBranch()
    {
        return $this->branchModel->all();
    }

    public function listWorkingPart()
    {
        return $this->workingPartModel->all();
    }

    public function listUser($role = '', $idUser = '')
    {

        return $this->userModel->when($role, function ($query) use ($role) {
            $query->where(function ($subQ) {
                $subQ->where('role', UserRole::STAFF)
                    ->orWhere('role', UserRole::APPROVER);
            });
        })
            ->when($idUser, function ($query) use ($idUser) {
                $query->where('id', '<>', $idUser);
            })
            ->orderBy('created_at', 'DESC')->get();
    }

    public function updateRole($idUser)
    {
        return $this->userModel->where('id', $idUser)
            ->update(['role' => UserRole::APPROVER]);
    }

    public function getInfo($idUser)
    {
        return $this->userModel->where('id', $idUser)->first();
    }

    public function removeRole($idUser)
    {
        $checkRole = $this->userModel
            ->where('approver_first', $idUser)
            ->orWhere('approver_second', $idUser)
            ->first();

        if (!$checkRole) {
            return $this->userModel->where('id', $idUser)
                ->update(['role' => UserRole::STAFF]);
        }
    }
}
