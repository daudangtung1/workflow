<?php

namespace App\Http\Controllers\Manager;

use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Manager\AbsenceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    protected $absenceService;

    public function __construct(AbsenceService $absenceService)
    {
        $this->absenceService = $absenceService;
    }

    public function index()
    {
        return view('manager.absence.index', [
            'staffs' => $this->absenceService->listUser(UserRole::STAFF),
            'branchs' => $this->absenceService->listBranch(),
            'active' => 'index',
            'approvers' => $this->absenceService->listUser(UserRole::APPROVER),
        ]);
    }

    public function show(Request $request)
    {
        $dataAbsence = $this->absenceService->listAbsence($request);

        return view('manager.absence.index', [
            'staffs' => $this->absenceService->listUser(UserRole::STAFF),
            'branchs' => $this->absenceService->listBranch(),
            'active' => 'show',
            'dataAbsence' => $dataAbsence,
            'approvers' => $this->absenceService->listUser(UserRole::APPROVER),
        ]);
    }

    public function update(Request $request, $type)
    {
        try {
            $this->absenceService->updateAbsence($request->id);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateInfo(Request $request, $type)
    {
        try {
            $data = [
                'user_id' => $request->user_register,
                'date' => $request->date,
                'option' => $request->option,
                'reason' => $request->reason,
                'approver' => $request->approver,
                'approval_date' => $request->approval_date ? Carbon::parse($request->approval_date)->format('Y-m-d H:i:s') : null,
                'manager_confirm' => null,
                'id' => $request->id,
            ];

            if ($request->manager_status_edit == ManagerStatus::PROCESSED) {
                $data['manager_confirm'] = auth()->user()->id;
            }

            $this->absenceService->updateInfoAbsence($data);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function destroy(Request $request, $id)
    {
        $this->absenceService->deleteAbsence($request->id);

        return redirect()->back()->with('success', __('common.delete.success'));

    }
}
