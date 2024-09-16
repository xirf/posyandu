<?php

use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard')->group(function () {
    Route::view('/', 'dashboard');
    Route::view('/activity', 'dashboard')->name('.activity');
    Route::view('/user', 'dashboard')->name('.user');

    Route::prefix('news')->name('.news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/new', [NewsController::class, 'create'])->name('.new');
        Route::post('/new', [NewsController::class, 'store'])->name('.store');
    });

    Route::prefix('activity')->name('.activity')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index']);
    });
    
    Route::prefix('posyandu')->name('.posyandu')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index']);
        Route::get('/new', [MedicalRecordController::class, 'index'])->name('.new');
    });

    Route::prefix('user')->name('.users')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index']);
    });
});

require __DIR__ . '/auth.php';
