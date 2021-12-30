<?php

namespace App\Services\Approver;

use App\Models\Absence;
use App\Models\OvertimeRegister;
use App\Models\ParttimeRegister;
use App\Models\Vacation;
use App\Services\BaseService;
use Carbon\Carbon;

class ApproverService extends BaseService
{
    protected $overTimeModel;
    protected $partTimeModel;
    protected $vacationModel;
    protected $absenceModel;
    protected $dates;

    public function __construct(
        OvertimeRegister $overTimeModel,
        ParttimeRegister $partTimeModel,
        Absence $absenceModel,
        Vacation $vacationModel
    ) {
        $this->overTimeModel = $overTimeModel;
        $this->partTimeModel = $partTimeModel;
        $this->absenceModel = $absenceModel;
        $this->vacationModel = $vacationModel;

        //if datenow < 11 -1 month
        $this->dates = $this->getMonth(Carbon::now()->format('Y-m'));
        $dayNow = Carbon::now()->format('d');

        if ($dayNow <= '11')
            $this->dates = $this->getMonth(Carbon::now()->subMonth()->format('Y-m'));
    }

    public function getOverTime()
    {
        $dates = $this->dates;

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->overTimeModel
            // ->whereBetween('date', [$from, $to])
            ->where('date', '>=', $from)
            ->whereNull('approver')
            ->whereHas('user', function ($query) {
                $query->where('approver_first', auth()->user()->id);
                $query->orWhere('approver_second', auth()->user()->id);
            })
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function getPartTime()
    {
        $dates = $this->dates;

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->partTimeModel
            // ->whereBetween('date', [$from, $to])
            ->where('date', '>=', $from)
            ->whereNull('approver')
            ->whereHas('user', function ($query) {
                $query->where('approver_first', auth()->user()->id);
                $query->orWhere('approver_second', auth()->user()->id);
            })
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function getVacation()
    {
        $dates = $this->dates;

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->vacationModel
            ->whereNull('approver')
            // ->whereBetween('start_date', [$from, $to])
            ->where('start_date', '>=', $from)
            ->whereHas('user', function ($query) {
                $query->where('approver_first', auth()->user()->id);
                $query->orWhere('approver_second', auth()->user()->id);
            })
            ->orderBy('start_date', 'DESC')
            ->get();
    }

    public function getAbsence()
    {
        $dates = $this->dates;

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->absenceModel
            ->whereNull('approver')
            // ->whereBetween('date', [$from, $to])
            ->whereHas('user', function ($query) {
                $query->where('approver_first', auth()->user()->id);
            })
            ->where('date', '>=', $from)
            ->orderBy('date', 'DESC')
            ->get();
    }
}
