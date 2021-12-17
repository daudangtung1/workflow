<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $arrRole = [
                UserRole::MANAGER => 'manager',
                UserRole::STAFF => 'staff',
                UserRole::APPROVER => 'approver',
            ];

            $role = Auth::user()->role;

            return redirect()->route($arrRole[$role] . '.home');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;

        $checkEmail = ['email' => $request->username, 'password' => $request->password];
        $checkId = ['user_id' => $request->username, 'password' => $request->password];

        if (Auth::attempt($checkEmail, $remember) || Auth::attempt($checkId, $remember)) {
            $arrRole = [
                UserRole::MANAGER => 'manager',
                UserRole::STAFF => 'staff',
                UserRole::APPROVER => 'approver',
            ];

            $role = Auth::user()->role;

            //check  active account
            if (Auth::user()->join_date <= Carbon::now()->format('Y-m-d') && !Auth::user()->off_date)
                return redirect()->route($arrRole[$role] . '.home');

            
            if(Auth::user()->join_date > Carbon::now()->format('Y-m-d')) return redirect()->back()->with('error', 'アカウントまたはパスワードが無効です。');
            
            if(Auth::user()->off_date) return redirect()->back()->with('error', '退職日以降はログインできません。');

            Auth::logout();
        }

        return redirect()->back()->with('error', 'アカウントまたはパスワードが無効です。');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function changePasswordForm()
    {
        return view('auth.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {       
        $user = Auth::user();
    
        $userPassword = $user->password;

        if (!Hash::check($request->old_password, $userPassword)) {
            return back()->withErrors(['old_password'=>'パスワードが違います。']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        $arrRole = [
            UserRole::MANAGER => 'manager',
            UserRole::STAFF => 'staff',
            UserRole::APPROVER => 'approver',
        ];

        return redirect()->route($arrRole[$user->role] . '.home')->with('success', 'パスワードの更新は成功しました。');
    }
}
