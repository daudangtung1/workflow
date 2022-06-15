<?php

namespace App\Http\Controllers\Manager;

use App\Enums\ManagerStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Services\Manager\ApprovalByMonthService;
use App\Services\Manager\CensorshipService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Services\Manager\OverTimeService;
use App\Services\Manager\PartTimeService;

class CensorshipController extends Controller
{
    protected $censorshipService;

    protected $approvalByMonthService;

    public function __construct(CensorshipService $censorshipService, ApprovalByMonthService $approvalByMonthService)
    {
        $this->censorshipService = $censorshipService;
        $this->approvalByMonthService = $approvalByMonthService;
    }

    public function index(Request $request)
    {
        $listRegister = $this->censorshipService->getAll($request);

        return view('manager.censorship.index', [
            'listRegister' => $listRegister,
            'active'       => 'index',
        ]);
    }

    public function search(Request $request)
    {
        $items = $this->censorshipService->getAll($request);

        return view('manager.censorship.index', [
            'items'  => $items,
            'active' => 'list',
        ]);
    }

    public function show(Request $request)
    {
        $items = $this->censorshipService->getAll($request);
        $data = $this->censorshipService->find($request);

        $dateData = $this->getDate($request);

        return view('manager.censorship.index', [
            'items'    => $items,
            'data'     => $data,
            'dateData' => $dateData,
            'active'   => 'show',
        ]);
    }

    public function approvalByMonth(Request $request)
    {
        try {
            $this->approvalByMonthService->store($request);

            return redirect()->back()->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function getDate($request)
    {
        if (empty($request->date)) {
            return [];
        }

        $currentDate = Carbon::parse($request->date);
        $endMonth = clone $currentDate;
        $startMonth = $currentDate->startOfMonth();
        $endMonth = $endMonth->endOfMonth();
        $dateRange = CarbonPeriod::create($startMonth, $endMonth);

        $prevMonth = Carbon::parse($request->date)->subMonth(1);
        $nextMonth = Carbon::parse($request->date)->addMonth(1);

        return [
            'dateRange' => $dateRange,
            'prevMonth' => $prevMonth,
            'nextMonth' => $nextMonth,
        ];
    }
}
