<?php

namespace App\Services\Staff;

use App\Services\BaseService;
use App\Models\ParttimeRegister;
use Carbon\Carbon;

class PartTimeService extends BaseService
{
    public function __construct(ParttimeRegister $model)
    {
        $this->model = $model;
    }

    public function registerPartTime($data = [])
    {
        return $this->model->create($data);
    }
}
