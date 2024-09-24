<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\SiteInfoController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/site-info', [SiteInfoController::class, 'update'])->name('site-info.update');
});



Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'show']);

    Route::prefix('news')->name('.news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/new', [NewsController::class, 'create'])->name('.new');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('.edit');

        Route::post('/update/{id}', [NewsController::class, 'update'])->name('.update');
        Route::post('/new', [NewsController::class, 'store'])->name('.store');
    });

    Route::prefix('activity')->name('.activity')->group(function () {
        Route::get('/', [ActivityController::class, 'index']);
        Route::get('/new', [ActivityController::class, 'create'])->name('.new');
        Route::post('/new', [ActivityController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('.edit');

        Route::post('/update', [ActivityController::class, 'store'])->name('.update');
        Route::post('/update/{id}', [ActivityController::class, 'update'])->name('.update');
    });

    Route::prefix('posyandu')->name('.posyandu')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index']);
        Route::get('/new', [MedicalRecordController::class, 'create'])->name('.create');
        Route::get('/edit/{id}', [MedicalRecordController::class, 'edit'])->name('.edit');
        Route::delete('/delete/{id}', [MedicalRecordController::class, 'destroy'])->name('.delete');
        Route::post('/update/{id}', [MedicalRecordController::class, 'update'])->name('.update');
    });

    Route::prefix('user')->name('.users')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index']);
    });

    Route::prefix('site-info')->name('.site-info')->group(function () {
        Route::get('/', [SiteInfoController::class, 'index']);
    });

    Route::post('/schedule/add', [ScheduleController::class, 'store'])->name('.schedule.add');
    Route::delete('/schedule/delete/{id}', [ScheduleController::class, 'destroy'])->name('.schedule.delete');

    Route::get('/medical-record/export/{year}/{month}', [MedicalRecordController::class, 'export'])->name('.medical-record.export.monthly');
    Route::get('/medical-record/export/{year}', [MedicalRecordController::class, 'exportAll'])->name('.medical-record.export.yearly');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/guest.php';
