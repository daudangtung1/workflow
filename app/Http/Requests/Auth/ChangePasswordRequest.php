<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
   
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'old_password' => '以前のパスワード',
            'password' => '新しいパスワード',
            'confirm_password' => 'パスワードを再設定',
        ];
    }

    public function messages()
    {
        return [
            'confirm_password.same' => 'パスワードが一致しません。',
        ];
    }
}
