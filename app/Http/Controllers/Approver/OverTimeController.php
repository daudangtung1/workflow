<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Services\ApproverMonth\OverTimeService;
use Illuminate\Http\Request;
use App\Enums\UserRole;

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
            'staffs' => $this->overtimeService->listUser(UserRole::STAFF),
            'branchs' => $this->overtimeService->listBranch(),
            'active' => 'index',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->overtimeService->updateApprover($request->id);
            $dataRegister = $this->overtimeService->listOverTime($request);
            $listCalendarData = $this->overtimeService->listCalendarFull();
            $view = view('approver.over-time.table', compact('dataRegister', 'listCalendarData'))->render();
            return response()->json(array('statusCode' => 200, 'html' => $view));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Request $request, $id)
    {
        $dataRegister = $this->overtimeService->listOverTime($request);
        $listCalendarData = $this->overtimeService->listCalendarFull();
        return view('approver.over-time.index', [
            'staffs' => $this->overtimeService->listUser(),
            'branchs' => $this->overtimeService->listBranch(),
            'active' => 'show',
            'dataRegister' =>  $dataRegister,
            'approvers' => $this->overtimeService->listUser(UserRole::APPROVER),
        ], compact('listCalendarData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->overtimeService->cancelApprover($request->id);
            $dataRegister = $this->overtimeService->listOverTime($request);
            $listCalendarData = $this->overtimeService->listCalendarFull();
            $view = view('approver.over-time.table', compact('dataRegister', 'listCalendarData'))->render();
            return response()->json(array('statusCode' => 200, 'html' => $view));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
