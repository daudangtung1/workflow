<?php

use App\Http\Controllers\Manager\OverTimeController;
use App\Http\Controllers\Manager\StaffController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth.manager'], function () {
    Route::get('home', function () {
        return view('manager.app');
    })->name('home');

    Route::resource('staff', StaffController::class);
    Route::resource('over-time', OverTimeController::class);
});
