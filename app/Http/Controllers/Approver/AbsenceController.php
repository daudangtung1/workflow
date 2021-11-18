<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Services\Approver\AbsenceService;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    protected $absenceService;

    public function __construct(AbsenceService $absenceService)
    {
        $this->absenceService = $absenceService;
    }

    public function index(Request $request)
    {
        $listAbsence = $this->absenceService->listAbsence($request->absence);

        return view('approver.absence.index', [
            'listAbsence' => $listAbsence,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->absenceService->updateApprover($request->id);

            return redirect()->route('approver.absence.index')->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
