<?php

use App\Http\Controllers\Staff\AbsenceController;
use App\Http\Controllers\Staff\OverTimeController;
use App\Http\Controllers\Staff\PartTimeController;
use App\Http\Controllers\Staff\VacationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth.staff'], function () {
    Route::get('home', function () {
        return view('staff.app');
    })->name('home');

    Route::resource('over-time', OverTimeController::class);
    Route::resource('part-time', PartTimeController::class);
    Route::resource('vacation', VacationController::class);
    Route::resource('absence', AbsenceController::class);
});
