<?php

namespace App\Http\Requests\Manager\Staff;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateStaffRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_id' => [
                Rule::unique('users')->ignore($this->id),
                'required',
                'integer'
            ],
            'approver_first' => 'required',
            'approver_second' => 'required',
            'start_time_working' => 'required',
            'end_time_working' => 'required',
            'password' => 'nullable|min:6',
            'email' => [
                Rule::unique('users')->ignore($this->id),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'approver_first' => '承認者1社員ID',
            'approver_second' => '承認者2社員ID',
            'user_id' => '社員ID',
            'password' => 'パスワード',
            'email' => 'メールアドレス',
            'start_time_working' => '始業時刻',
            'end_time_working' => '終業時刻',
        ];
    }
}
