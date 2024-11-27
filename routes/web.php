<?php

use Illuminate\Support\Facades\Route;

// Rute utama untuk aplikasi single-page
Route::get('/', function () {
    return view('layout.navhome'); // Template utama
})->name('navhome');
