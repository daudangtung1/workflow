<?php

namespace App\Http\Controllers\Staff;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Staff\VacationService;
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
        $listVacation =  $this->vacationService->listVacation();

        return view('staff.vacation.index', [
            'listVacation' => $listVacation,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $data = [
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
                'type' => $request->type,
            ];
            $this->vacationService->createVacation($data);

            return redirect()->route('staff.vacation.index')->with('success', __('common.create.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    
    public function edit(Request $request, $id)
    {
        $listVacation =  $this->vacationService->listVacation();

        $infoVacation =  $this->vacationService->infoVacation($id);

        return view('staff.vacation.index', [
            'listVacation' => $listVacation,
            'infoVacation' => $infoVacation,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'type' => $request->type,
        ];
        $this->vacationService->updateVacation($data, $id);

        return redirect()->route('staff.vacation.index')->with('success', __('common.update.success'));
    }
}
