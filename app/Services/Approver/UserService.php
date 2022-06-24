<?php

namespace App\Services\Approver;

use App\Models\ParttimeRegister;
use App\Services\BaseService;
use Carbon\Carbon;
use App\Models\User;

class UserService extends BaseService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function find($request)
    {
        return $this->model->findOrFail($request->user_id);
    }
}
