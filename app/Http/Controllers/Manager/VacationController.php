<?php

namespace App\Http\Controllers\Manager;

use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Manager\VacationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    protected $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function index()
    {
        return view('manager.vacation.index', [
            'staffs' => $this->vacationService->listUser(UserRole::STAFF),
            'branchs' => $this->vacationService->listBranch(),
            'active' => 'index',
            'approvers' => $this->vacationService->listUser(UserRole::APPROVER),
            'listCalendar' => $this->vacationService->listCalendar(),
        ]);
    }

    public function updateVacation(Request $request, $type)
    {
        try {
            $data = [
                'user_id' => $request->user_register,
                'start_date' => $request->start_date_register,
                'end_date' => $request->end_date_register,
                'type' => $request->type  == 'vacation' ? $request->option_vacation : $request->type,
                'reason' => $request->reason,
                'approver' => $request->approver,
                'approval_date' => $request->approval_date ? Carbon::parse($request->approval_date)->format('Y-m-d H:i:s') : null,
                'manager_confirm' => null,
                'id' => $request->id,
            ];

            if ($request->manager_status_edit == ManagerStatus::PROCESSED) {
                $data['manager_confirm'] = auth()->user()->id;
            }

            $this->vacationService->updateInfoVacation($data);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function show(Request $request)
    {
        $dataVacation = $this->vacationService->listVacation($request);

        return view('manager.vacation.index', [
            'staffs' => $this->vacationService->listUser(UserRole::STAFF),
            'branchs' => $this->vacationService->listBranch(),
            'active' => 'show',
            'dataVacation' => $dataVacation,
            'approvers' => $this->vacationService->listUser(UserRole::APPROVER),
            'listCalendar' => $this->vacationService->listCalendar(),
        ]);
    }

    public function update(Request $request, $type)
    {
        try {
            $this->vacationService->updateVacation($request->id);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->vacationService->deleteVacation($request->id);

        return redirect()->back()->with('success', __('common.delete.success'));

    }
}
