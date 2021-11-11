<?php

use App\Http\Controllers\Staff\OverTimeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth.staff'], function () {
    Route::get('home', function () {
        return view('staff.app');
    })->name('home');

    Route::resource('over-time', OverTimeController::class);
});
