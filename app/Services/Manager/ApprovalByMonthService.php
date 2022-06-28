<?php

namespace App\Services\Manager;

use App\Models\ApprovalByMonth;
use App\Services\BaseService;
use Carbon\Carbon;

class ApprovalByMonthService extends BaseService
{
    protected $model;

    public function __construct(ApprovalByMonth $approvalByMonth)
    {
        $this->model = $approvalByMonth;
    }

    public function store($request)
    {
        $dataInput = $request->data_input ?? null;

        if (empty($dataInput)) {
            return;
        }

        foreach ($dataInput as $modelName => $input) {
            foreach ($input as $ids) {
                $ids = json_decode($ids);
                foreach ($ids as $id) {
                    $this->model->create([
                        'modelable_type' => 'App\Models\\' . $modelName,
                        'modelable_id'   => $id,
                        'date'       => Carbon::now()
                    ]);
                }
            }
        }
    }
}
