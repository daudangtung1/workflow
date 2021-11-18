<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Services\Approver\VacationService;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    protected $vacationService;

    public function __construct(VacationService $vacationService)
    {
        $this->vacationService = $vacationService;
    }

    public function index(Request $request)
    {
        $listVacation = $this->vacationService->listVacation($request->vacation);

        return view('approver.vacation.index', [
            'listVacation' => $listVacation,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->vacationService->updateApprover($request->id);

            return redirect()->route('approver.vacation.index')->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
