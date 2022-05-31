<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Staff\OverTimeController;
use App\Http\Controllers\Staff\PartTimeController;
use App\Http\Controllers\Staff\VacationController;
use Illuminate\Support\Composer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('change-password', [LoginController::class, 'changePasswordForm'])->name('change_password');
    Route::post('change-password', [LoginController::class, 'changePassword'])->name('change_password');
});
Route::group(['middleware' => 'auth.staff'], function () {
    Route::resource('/staff-over-time', OverTimeController::class);
    Route::resource('/staff-part-time', PartTimeController::class);
    Route::resource('/staff-vacation', VacationController::class);
});
Route::get('config/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');

    print_r('clear cache complete');
});
