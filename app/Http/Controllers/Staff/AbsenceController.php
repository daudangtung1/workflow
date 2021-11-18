<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Services\Staff\AbsenceService;
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
        $listAbsence = $this->absenceService->listAbsence();

        return view('staff.absence.index', [
            'listAbsence' => $listAbsence,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $data = [
                'user_id' => $user->id,
                'date' => $request->date,
                'reason' => $request->reason,
                'option' => $request->option,
            ];
            $this->absenceService->createAbsence($data);

            return redirect()->route('staff.absence.index')->with('success', __('common.create.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Absence $absence)
    {
        $listAbsence = $this->absenceService->listAbsence();

        return view('staff.absence.index', [
            'listAbsence' => $listAbsence,
            'infoAbsence' => $absence,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'date' => $request->date,
                'reason' => $request->reason,
                'option' => $request->option,
            ];
            $this->absenceService->updateAbsence($data, $id);

            return redirect()->route('staff.absence.index')->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
