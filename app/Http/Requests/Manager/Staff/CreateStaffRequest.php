<?php

namespace App\Http\Requests\Manager\Staff;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\JsonResponse;

class CreateStaffRequest extends BaseRequest
{
    public function rules()
    {
        $this->redirect = route('manager.staff.index');
        return [
            'user_id' => 'unique:users|required|integer',
            // 'approver_first' => 'required',
            // 'approver_second' => 'required',
            'start_time_working' => 'required',
            'end_time_working' => 'required',
            'password' => 'min:6',
            'email' => 'unique:users',
        ];
    }

    public function attributes()
    {
        return [
            // 'approver_first' => '承認者1社員ID',
            // 'approver_second' => '承認者2社員ID',
            'user_id' => '社員ID',
            'password' => 'パスワード',
            'email' => 'メールアドレス',
            'start_time_working' => '始業時刻',
            'end_time_working' => '終業時刻',
        ];
    }
}
