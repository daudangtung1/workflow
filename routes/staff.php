<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth.staff'], function () {
    Route::get('home', function () {
        return view('staff.app');
    })->name('home');
});
