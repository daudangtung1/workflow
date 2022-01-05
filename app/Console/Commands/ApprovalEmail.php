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
        $afterDay = Carbon::now()->subDay(3);
        $overTimeDelay = OvertimeRegister::where('created_at', '<', $afterDay)
            ->whereNull('approver')
            ->get();

        foreach ($overTimeDelay as $item) {
            $approver1 = User::find($item->user->approver_first ?? 0);
            $approver2 = User::find($item->user->approver_first ?? 0);

            if(isset($approver1->email))
                Log::info($approver1->notify(new NotifyApprovalEmail()));

            if(isset($approver2->email))
                Log::info($approver2->notify(new NotifyApprovalEmail()));
        }

        $partTimeDelay = ParttimeRegister::where('created_at', '<', $afterDay)
            ->whereNull('approver')
            ->get();

        foreach ($partTimeDelay as $item) {
            $approver1 = User::find($item->user->approver_first ?? 0);
            $approver2 = User::find($item->user->approver_first ?? 0);

            if(isset($approver1->email))
                Log::info($approver1->notify(new NotifyApprovalEmail()));

            if(isset($approver2->email))
                Log::info($approver2->notify(new NotifyApprovalEmail()));
        }

        $vacationDelay = Vacation::where('created_at', '<', $afterDay)
            ->whereNull('approver')
            ->get();

        foreach ($vacationDelay as $item) {
            $approver1 = User::find($item->user->approver_first ?? 0);
            $approver2 = User::find($item->user->approver_first ?? 0);

            if(isset($approver1->email))
                Log::info($approver1->notify(new NotifyApprovalEmail()));

            if(isset($approver2->email))
                Log::info($approver2->notify(new NotifyApprovalEmail()));
        }


        //$user = User::find(1);
        //Log::info($overTimeDelay);
        // Log::info($user->notify(New NotifyApprovalEmail()));
        //return Command::SUCCESS;
    }
}
