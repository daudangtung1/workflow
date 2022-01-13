<?php

namespace App\Http\Controllers\Manager;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Staff\CreateStaffRequest;
use App\Http\Requests\Manager\Staff\UpdateStaffRequest;
use App\Models\User;
use App\Services\Manager\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index(Request $request)
    {
        $times = [];

        for ($i = 0; $i < 24; $i++) {
            $times[] = [
                'hour' => $i < 10 ? '0' . $i : $i,
                'minutes' => [
                    '00' => "00",
                    '30' => '30',
                ],
            ];
        }
        $arrParam = [
            'branchs' => $this->staffService->listBranch(),
            'workingParts' => $this->staffService->listWorkingPart(),
            'approvers' => $this->staffService->listUser(),
            // 'managers' => $this->staffService->listUser(UserRole::MANAGER),
            'times' => $times,
            'listStaff' => [],
        ];


        if ($request->list)
            $arrParam['listStaff'] = $this->staffService->listUser();

        return view('manager.staff.index', $arrParam);
    }

    public function store(CreateStaffRequest $request)
    {
        try {
            $role = UserRole::STAFF;

            if ($request->manager) $role = UserRole::MANAGER;


            $data = [
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'join_date' => $request->join_date,
                'off_date' => $request->off_date,
                'type' => $request->type,
                'branch_id' => $request->branch_id,
                'working_part_id' => $request->working_part_id,
                'approver_first' => $request->approver_first,
                'approver_second' => $request->approver_second,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'start_time_working' => $request->start_time_working,
                'end_time_working' => $request->end_time_working,
                'role' => $role,
            ];
            $this->staffService->createStaff($data);

            //update role
            if ($request->approver_first)
                $this->staffService->updateRole($request->approver_first);

            if ($request->approver_second)
                $this->staffService->updateRole($request->approver_second);

            return redirect()->route('manager.staff.index')->with('success', __('common.create.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        $times = [];

        for ($i = 0; $i < 24; $i++) {
            $times[] = [
                'hour' => $i < 10 ? '0' . $i : $i,
                'minutes' => [
                    '00' => "00",
                    '30' => '30',
                ],
            ];
        }

        $arrParam = [
            'branchs' => $this->staffService->listBranch(),
            'workingParts' => $this->staffService->listWorkingPart(),
            'approvers' => $this->staffService->listUser('', $id),
            // 'managers' => $this->staffService->listUser(UserRole::MANAGER),
            'times' => $times,
            'action' => 'update',
            'infoUser' => User::findOrFail($id),
            'listStaff' => [],
        ];

        return view('manager.staff.index', $arrParam);
    }


    public function update(UpdateStaffRequest $request, $id)
    {
        try {
            $role = UserRole::STAFF;

            if ($request->manager) $role = UserRole::MANAGER;

            //remove role old id
            $user = $this->staffService->getInfo($id);

            $data = [
                'user_id' => $request->user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'join_date' => $request->join_date,
                'off_date' => $request->off_date,
                'type' => $request->type,
                'branch_id' => $request->branch_id,
                'working_part_id' => $request->working_part_id,
                'approver_first' => $request->approver_first,
                'approver_second' => $request->approver_second,
                'email' => $request->email,
                'start_time_working' => $request->start_time_working,
                'end_time_working' => $request->end_time_working,
                'role' => $role,
            ];

            if ($request->password)
                $data['password'] = bcrypt($request->password);

            $this->staffService->updateStaff($data, $id);

            //update role
            if ($request->approver_first != $user->approver_first) {
                $this->staffService->updateRole($request->approver_first);
                $this->staffService->removeRole($user->approver_first);
            }

            if ($request->approver_second != $user->approver_second) {
                $this->staffService->updateRole($request->approver_second);
                $this->staffService->removeRole($user->approver_second);
            }

            return redirect()->route('manager.staff.edit', $id)->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
