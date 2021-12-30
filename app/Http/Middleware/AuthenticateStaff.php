<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Services\Approver\ApproverService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $approverService;

    public function __construct(ApproverService $approverService)
    {
        $this->approverService = $approverService;
    }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {
            if(Auth::user()->role == UserRole::APPROVER) {
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
