<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Middleware\Localization;

// Rute utama untuk halaman awal
Route::get('/', function () {
    return view('layout.navhome'); // Template utama untuk home
})->name('navhome');

// Rute untuk mengganti bahasa
Route::get('/change-language/{lang}', function ($lang) {
    // Menyimpan locale di session
    session(['locale' => $lang]);
    return redirect()->back();
})->name('change.language');

// Rute dengan middleware localization
Route::middleware([Localization::class])->group(function () {
    // Rute untuk halaman statis lainnya
    Route::view('/home', 'studenthome.home')->name('home');
    Route::view('/about', 'studenthome.about')->name('about');
    Route::view('/contact', 'studenthome.contact')->name('contact');

    // Halaman setelah login
    Route::get('/navboard', function () {
        return view('layout.navboard');
    })->name('navboard');

    // Halaman dalam dashboard
    Route::view('/dashboard', 'studentboard.dashboard')->name('dashboard');
    Route::view('/profile', 'studentboard.profile')->name('profile');
    Route::view('/result', 'studentboard.result')->name('result');

    // Route langsung ke halaman exam
    Route::get('/exam', function () {
        return view('studentboard.exam');
    })->name('exam');


});

// Rute untuk mengambil terjemahan dalam format JSON
Route::get('/lang/{locale}/messages', function ($locale) {
    // Pastikan locale valid dan file messages.php tersedia
    $path = resource_path("lang/{$locale}/messages.php");

    if (file_exists($path)) {
        $translations = include $path;
        return response()->json($translations); // Kembalikan dalam format JSON
    }

    return response()->json(['error' => 'Translation file not found'], 404); // Jika tidak ditemukan
});

Route::get('/logout', function () {
    // Logika logout atau pengalihan halaman logout
    return redirect()->route('navhome');
})->name('logout');

