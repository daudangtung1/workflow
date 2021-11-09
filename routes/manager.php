<?php

use Illuminate\Support\Facades\Route;

Route::get('home', function () {
    return view('layouts.master');
})->name('home');
