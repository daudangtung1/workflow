<?php

use App\Http\Controllers\Approver\AbsenceController;
use App\Http\Controllers\Approver\OverTimeController;
use App\Http\Controllers\Approver\PartTimeController;
use App\Http\Controllers\Approver\VacationController;
use App\Http\Controllers\Approver\StaffOverTimeController;
use App\Http\Controllers\Approver\StaffPartTimeController;
use App\Http\Controllers\Approver\StaffVacationController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth.staff'], function () {
    Route::get('home', function () {
        return view('approver.index');
    })->name('home');

    // Route::get('/over-time', [OverTimeController::class, 'index'])->name('over_time.index');
    // Route::post('/over-time', [OverTimeController::class, 'store'])->name('over_time.store');
    // Route::get('/part-time', [PartTimeController::class, 'index'])->name('part_time.index');
    // Route::post('/part-time', [PartTimeController::class, 'store'])->name('part_time.store');
    Route::get('/vacation', [VacationController::class, 'index'])->name('vacation.index');
    Route::post('/vacation', [VacationController::class, 'store'])->name('vacation.store');
    Route::get('/absence', [AbsenceController::class, 'index'])->name('absence.index');
    Route::post('/absence', [AbsenceController::class, 'store'])->name('absence.store');

    Route::resource('staff-over-time', StaffOverTimeController::class);
    Route::resource('staff-part-time', StaffPartTimeController::class);
    Route::resource('staff-vacation', StaffVacationController::class);
    Route::resource('overtime', OverTimeController::class);
    Route::resource('parttime', PartTimeController::class);
});
