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
    }

    public function getOverTime()
    {
        $dates = $this->getMonth(Carbon::now()->format('Y-m'));

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->overTimeModel
            ->whereBetween('date', [$from, $to])
            ->whereNull('approver')
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function getPartTime()
    {
        $dates = $this->getMonth(Carbon::now()->format('Y-m'));

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->partTimeModel
            ->whereBetween('date', [$from, $to])
            ->whereNull('approver')
            ->orderBy('date', 'DESC')
            ->get();
    }

    public function getVacation()
    {
        $dates = $this->getMonth(Carbon::now()->format('Y-m'));

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->vacationModel
            ->whereNull('approver')
            ->orderBy('start_date', 'DESC')
            ->whereBetween('start_date', [$from, $to])->get();
    }

    public function getAbsence()
    {
        $dates = $this->getMonth(Carbon::now()->format('Y-m'));

        $from = $dates['current'] . '-11';
        $to = $dates['next'] . '-10';

        return $this->absenceModel
            ->whereNull('approver')
            ->whereBetween('date', [$from, $to])
            ->orderBy('date', 'DESC')
            ->get();
    }
}
