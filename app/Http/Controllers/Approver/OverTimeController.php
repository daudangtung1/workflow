<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Services\Approver\OverTimeService;
use Illuminate\Http\Request;

class OverTimeController extends Controller
{
    protected $overtimeService;

    public function __construct(OverTimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function index(Request $request)
    {
        $listRegister = $this->overtimeService->listRegister($request->overTime);

        return view('approver.over-time.index', [
            'listRegister' => $listRegister,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->overtimeService->updateApprover($request->id);

            return redirect()->route('approver.over_time.index')->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
