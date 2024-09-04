<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'verified'])->name('dashboard', function () {
//     Route::get('/', function () { return view('dashboard'); });
//     Route::get('/news', function () { return view('dashboard'); })->name('news');
//     Route::get('/activity', function () { return view('dashboard'); })->name('activity');
//     Route::get('/posyandu', function () { return view('dashboard'); })->name('posyandu');
//     Route::get('/user', function () { return view('dashboard'); })->name('user');
// })->as('dashboard');


Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard')->group(function () {
    Route::get('/', function () { return view('dashboard'); });
    Route::get('/news', [NewsController::class, 'index'])->name('.news');
    Route::get('/activity', function () { return view('dashboard'); })->name('.activity');
    Route::get('/posyandu', function () { return view('dashboard'); })->name('.posyandu');
    Route::get('/user', function () { return view('dashboard'); })->name('.user');
});

require __DIR__ . '/auth.php';
