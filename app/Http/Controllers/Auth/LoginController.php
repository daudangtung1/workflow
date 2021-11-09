<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

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

            return redirect()->route($arrRole[$role] . '.home');
        }

        return redirect()->back()->with('error', 'Incorrect username or password.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
