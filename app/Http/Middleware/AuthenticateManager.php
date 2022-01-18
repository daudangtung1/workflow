<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Approver\ApproverService;

class AuthenticateManager
{
    protected $approverService;

    public function __construct(ApproverService $approverService)
    {
        $this->approverService = $approverService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role == UserRole::MANAGER) {
            if (Auth::user()->active_menu_approver == \App\Enums\UserApproverMenu::SHOW) {
                $request->overTime = $this->approverService->getOverTime();
                $request->partTime = $this->approverService->getPartTime();
                $request->absence = $this->approverService->getAbsence();
                $request->vacation = $this->approverService->getVacation();
            }

            return $next($request);
        }

        return redirect()->route('login');
    }
}
