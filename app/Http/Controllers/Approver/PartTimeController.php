<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Services\ApproverMonth\PartTimeService;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class PartTimeController extends Controller
{
    protected $parttimeService;

    public function __construct(PartTimeService $parttimeService)
    {
        $this->parttimeService = $parttimeService;
    }

    public function index(Request $request)
    {
        $listRegister = $this->parttimeService->listRegister($request->partTime);

        return view('approver.part-time.index', [
            'listRegister' => $listRegister,
            'staffs' => $this->parttimeService->listUserApprove(),
            'branchs' => $this->parttimeService->listBranch(),
            'active' => 'index',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->parttimeService->updateApprover($request->id);
            $dataRegister = $this->parttimeService->listPartTime($request);
            $listCalendarData = $this->parttimeService->listCalendarFull();
            $view = view('approver.part-time.table', compact('dataRegister', 'listCalendarData'))->render();
            $count_data= view('approver.part-time.count', ['count' => count($dataRegister) ? count($dataRegister) : 0])->render();
            return response()->json(array('statusCode' => 200, 'html' => $view, 'count' => $count_data));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function show(Request $request, $id)
    {
        $dataRegister = $this->parttimeService->listPartTime($request);
        $listCalendarData = $this->parttimeService->listCalendarFull();
        return view('approver.part-time.index', [
            'dataRegister' => $dataRegister,
            'active' => 'show',
            'approvers' => $this->parttimeService->listUser(UserRole::APPROVER),
            'staffs' => $this->parttimeService->listUser(),
            'branchs' => $this->parttimeService->listBranch(),
            'count' => count($dataRegister),
        ], compact('listCalendarData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->parttimeService->cancelApprover($request->id);
            $dataRegister = $this->parttimeService->listPartTime($request);
            $listCalendarData = $this->parttimeService->listCalendarFull();
            $view = view('approver.part-time.table', compact('dataRegister', 'listCalendarData'))->render();
            $count_data= view('approver.part-time.count', ['count' => count($dataRegister) ? count($dataRegister) : 0])->render();
            return response()->json(array('statusCode' => 200, 'html' => $view, 'count' => $count_data));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
