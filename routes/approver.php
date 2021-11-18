<?php

use App\Http\Controllers\Approver\OverTimeController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth.approver'], function () {
    Route::get('home', function () {
        return view('approver.app');
    })->name('home');
    
    Route::get('/over-time', [OverTimeController::class, 'index'])->name('over_time.index');
    Route::post('/over-time', [OverTimeController::class, 'store'])->name('over_time.store');
});
