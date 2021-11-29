<?php

use App\Http\Controllers\Manager\AbsenceController;
use App\Http\Controllers\Manager\VacationController;
use App\Http\Controllers\Manager\CalendarController;
use App\Http\Controllers\Manager\OverTimeController;
use App\Http\Controllers\Manager\PartTimeController;
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

    Route::get('absence', [AbsenceController::class, 'index'])->name('absence.index');
    Route::get('absence/{type}', [AbsenceController::class, 'show'])->name('absence.show');
    Route::put('absence/{type}', [AbsenceController::class, 'update'])->name('absence.update');
    Route::put('absence/update-info/{type}', [AbsenceController::class, 'updateInfo'])->name('absence.update_info');
    Route::delete('absence/{type}', [AbsenceController::class, 'destroy'])->name('absence.destroy');

    Route::get('part-time', [PartTimeController::class, 'index'])->name('part_time.index');
    Route::get('part-time/{type}', [PartTimeController::class, 'show'])->name('part_time.show');
    Route::put('part-time/{type}', [PartTimeController::class, 'update'])->name('part_time.update');
    Route::put('part-time/update-info/{type}', [PartTimeController::class, 'updateInfo'])->name('part_time.update_info');
    Route::delete('part-time/{type}', [PartTimeController::class, 'destroy'])->name('part_time.destroy');
});
