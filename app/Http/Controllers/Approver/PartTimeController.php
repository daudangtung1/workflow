<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Services\Approver\PartTimeService;
use Illuminate\Http\Request;

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
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->parttimeService->updateApprover($request->id);

            return redirect()->route('approver.part_time.index')->with('success', __('common.update.success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
