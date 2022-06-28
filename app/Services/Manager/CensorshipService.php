<?php

namespace App\Services\Manager;

use App\Models\Absence;
use App\Models\Branch;
use App\Models\User;
use App\Services\BaseService;
use Carbon\Carbon;

class CensorshipService extends BaseService
{
    protected $overTimeService;

    protected $partTimeService;

    public function __construct(OverTimeService $overTimeService, PartTimeService $partTimeService)
    {
        $this->overTimeService = $overTimeService;
        $this->partTimeService = $partTimeService;
    }

    public function getAll($request)
    {
        $date = $request->date ?? '';
        $statusApproval = $request->status_approval ?? '';

        $year = null;
        $month = null;
        if (!empty($date)) {
            $dateArr = explode('-', $date);
            $year = $dateArr[0];
            $month = $dateArr[1];
        }

        $partTimes = $this->partTimeService->filterByDate($year, $month, $statusApproval);
        $overTimes = $this->overTimeService->filterByDate($year, $month, $statusApproval);

        $data = [];
        $items = $partTimes->merge($overTimes);

        if (empty($items)) {
            return [];
        }

        $items = $items->sortBy('user_id');
        foreach ($items as $item) {
            if ($item->date) {
                $year = Carbon::createFromFormat('Y-m-d', $item->date)->format('Y');
                $month = Carbon::createFromFormat('Y-m-d', $item->date)->format('m');

                $data[$year . '-' . $month . '_' . class_basename($item)][$item->user_id][] = $item;
            }
        }

        return $data;
    }

    public function find($request)
    {
        $model = $request->model ?? '';
        $date = $request->date ?? '';
        $userId = $request->user_id ?? '';

        $year = null;
        $month = null;
        if ($date) {
            $dateArray = explode('-', $date);
            $year = $dateArray[0] ?? '';
            $month = $dateArray[1] ?? '';
        }

        if ($model == 'OvertimeRegister') {
            $data = $this->overTimeService->findByDate($year, $month, $userId);
        } else {
            $data = $this->partTimeService->findByDate($year, $month, $userId);
        }

        if (empty($data)) {
            return [];
        }

        $results = [];

        foreach ($data as $value) {
            $results[$value->date][] = $value;
        }

        return $results;
    }
}

?>
