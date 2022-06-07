<?php

namespace App\Http\Controllers\ApproverMonth;

use App\Http\Controllers\Controller;
use App\Services\Approver\OverTimeService;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class OverTimeController extends Controller
{
    protected $overTimeService;

    public function __construct(OverTimeService $overTimeService)
    {
        $this->overTimeService = $overTimeService;
    }

    public function index(Request $request)
    {

        return view('approver.over-time.index', [
            'active' => 'index',
            'staffs' => $this->overTimeService->listUser(UserRole::STAFF),
            'branchs' => $this->overTimeService->listBranch(),
        ]);

    }

    public function store(Request $request)
    {
        try {
            $this->overTimeService->updateApprover($request->id);
            return redirect()->route('approver.overtime.index')->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Request $request, $id)
    {
        $dataRegister = $this->overTimeService->listOverTime($request);
        $listRegister = $this->overTimeService->listRegister($request->overTime);
        // dd($dataRegister);
        return view('approver.over-time.index', [
            'active' => 'show',
            'dataRegister' =>  $dataRegister,
            'listCalendar' =>  $this->overTimeService->listCalendar(),
            'listRegister' => $listRegister,
            'staffs' => $this->overTimeService->listUser(UserRole::STAFF),
            'branchs' => $this->overTimeService->listBranch(),
        ]);
    }
}
