<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Services\Staff\PartTimeService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PartTimeController extends Controller
{
    protected $parttimeService;

    public function __construct(PartTimeService $parttimeService)
    {
        $this->parttimeService = $parttimeService;
    }


    public function index()
    {
        return view('staff.part-time.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $data = [
                'user_id' => $user->id,
                'date' => $request->date,
            ];

            if ($request->start_time_first < $request->end_time_first) {
                $data['start_time_first'] = $request->start_time_first;
                $data['end_time_first'] = $request->end_time_first;
            }

            if ($request->start_time_second < $request->end_time_second) {
                $data['start_time_second'] = $request->start_time_second;
                $data['end_time_second'] = $request->end_time_second;
            }

            if ($request->start_time_third < $request->end_time_third) {
                $data['start_time_third'] = $request->start_time_third;
                $data['end_time_third'] = $request->end_time_third;
            }

            $this->parttimeService->registerPartTime($data);

            return redirect()->route('staff.part-time.index')->with('success', __('common.message.success_create'));
        } catch (\Exception $e) {
            dd('');
            $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
