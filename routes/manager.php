<?php

use App\Http\Controllers\Manager\VacationController;
use App\Http\Controllers\Manager\CalendarController;
use App\Http\Controllers\Manager\OverTimeController;
use App\Http\Controllers\Manager\StaffController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth.manager'], function () {
    Route::get('home', function () {
        return view('manager.app');
    })->name('home');

    Route::resource('staff', StaffController::class);
    Route::resource('over-time', OverTimeController::class);
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');

    Route::get('vacation', [VacationController::class, 'index'])->name('vacation.index');
    Route::get('vacation/{type}', [VacationController::class, 'show'])->name('vacation.show');
    Route::put('vacation/{type}', [VacationController::class, 'update'])->name('vacation.update');
    Route::put('vacation/update-info/{type}', [VacationController::class, 'updateVacation'])->name('vacation.update_vacation');
    Route::delete('vacation/{type}', [VacationController::class, 'destroy'])->name('vacation.destroy');
});
