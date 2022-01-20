<?php

namespace App\Console\Commands;

use App\Models\Absence;
use App\Models\OvertimeRegister;
use App\Models\ParttimeRegister;
use App\Models\User;
use App\Models\Vacation;
use App\Notifications\NotifyApprovalEmail;
use App\Services\Manager\OverTimeService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\New_;
use PHPUnit\Framework\Error\Notice;

class ApprovalEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:approvalEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send approval email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = $this->getDate()['from'];
        $to = $this->getDate()['to'];

        $afterDay = Carbon::now()->subDay(3);
        $arrMail = [];

        //================ overtime ===================
        $overTimeDelay = OvertimeRegister::where('date', '<', $afterDay)
            ->where('date', '>=', $from)
            ->whereNull('approver')
            ->get();

        foreach ($overTimeDelay as $item) {
            if ($item->user->approver_first) {
                $user = $item->user->approver_first;
                $count = isset($arrMail[$user]['over_time']) ? $arrMail[$user]['over_time'] : 0;
                $arrMail[$user]['over_time'] =  $count + 1;
            }

            if ($item->user->approver_second && $item->user->approver_second != $item->user->approver_first) {
                $user = $item->user->approver_second;
                $count = isset($arrMail[$user]['over_time']) ? $arrMail[$user]['over_time'] : 0;
                $arrMail[$user]['over_time'] =  $count + 1;
            }

            // $approver1 = User::find($item->user->approver_first ?? 0);
            // $approver2 = User::find($item->user->approver_second ?? 0);

            // if (isset($approver1->email))
            //     Log::info($approver1->notify(new NotifyApprovalEmail(env('APP_URL') . 'approver/over-time')));

            // if (isset($approver2->email))
            //     Log::info($approver2->notify(new NotifyApprovalEmail(env('APP_URL') . 'approver/over-time')));
        }


        //================ parttime ===================
        $partTimeDelay = ParttimeRegister::where('date', '<', $afterDay)
            ->where('date', '>=', $from)
            ->whereNull('approver')
            ->get();

        foreach ($partTimeDelay as $item) {
            if ($item->user->approver_first) {
                $user = $item->user->approver_first;
                $count = isset($arrMail[$user]['part_time']) ? $arrMail[$user]['part_time'] : 0;
                $arrMail[$user]['part_time'] =  $count + 1;
            }

            if ($item->user->approver_second && $item->user->approver_second != $item->user->approver_first) {
                $user = $item->user->approver_second;
                $count = isset($arrMail[$user]['part_time']) ? $arrMail[$user]['part_time'] : 0;
                $arrMail[$user]['part_time'] =  $count + 1;
            }
            // $approver1 = User::find($item->user->approver_first ?? 0);
            // $approver2 = User::find($item->user->approver_second ?? 0);

            // if (isset($approver1->email))
            //     Log::info($approver1->notify(new NotifyApprovalEmail(env('APP_URL') . 'approver/part-time')));

            // if (isset($approver2->email))
            //     Log::info($approver2->notify(new NotifyApprovalEmail(env('APP_URL') . 'approver/part-time')));
        }

        //================ vacation ===================
        $vacationDelay = Vacation::where('start_date', '<', $afterDay)
            ->where('start_date', '>=', $from)
            ->whereNull('approver')
            ->get();

        foreach ($vacationDelay as $item) {
            if ($item->user->approver_first) {
                $user = $item->user->approver_first;
                $count = isset($arrMail[$user]['vacation']) ? $arrMail[$user]['vacation'] : 0;
                $arrMail[$user]['vacation'] =  $count + 1;
            }

            if ($item->user->approver_second && $item->user->approver_second != $item->user->approver_first) {
                $user = $item->user->approver_second;
                $count = isset($arrMail[$user]['vacation']) ? $arrMail[$user]['vacation'] : 0;
                $arrMail[$user]['vacation'] =  $count + 1;
            }
            // $approver1 = User::find($item->user->approver_first ?? 0);
            // $approver2 = User::find($item->user->approver_second ?? 0);

            // if (isset($approver1->email))
            //     Log::info($approver1->notify(new NotifyApprovalEmail(env('APP_URL') . 'approver/vacation')));

            // if (isset($approver2->email))
            //     Log::info($approver2->notify(new NotifyApprovalEmail(env('APP_URL') . 'approver/vacation')));
        }

        foreach ($arrMail as $userId => $item) {
            $user = User::find($userId);
            // Log::info($user->id);
            $user->notify(new NotifyApprovalEmail($item));
        }

        //$user = User::find(1);
        //Log::info($overTimeDelay);
        // Log::info($user->notify(New NotifyApprovalEmail()));
        //return Command::SUCCESS;
    }

    public function getDate()
    {

        $date = Carbon::now()->format('Y-m');
        //if datenow < 11 -1 month
        $dayNow = Carbon::now()->format('d');

        if ($dayNow <= '10')
            $date = Carbon::now()->subMonth()->format('Y-m');


        $from = Carbon::parse($date)->format('Y-m') . '-11';
        $to = Carbon::parse($date)->format('Y-m') . '-10';


        return [
            'from' => $from,
            'to' => $to,
        ];
    }
}
