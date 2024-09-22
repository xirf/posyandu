<?php

use App\Http\Controllers\Api\ActivityApiController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PatientApiController;
use App\Http\Controllers\Api\PosyanduApiController;
use App\Http\Controllers\Api\PosyanduTableController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/get/uploads', [FileController::class, "index"])->name('get.images');
    Route::post('/uploads', [FileController::class, "store"])->name('upload');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/posyandu/table', [PosyanduTableController::class, "index"])->name('posyandu.table');
    Route::get('/posyandu/table/search', [PosyanduTableController::class, "search"])->name('posyandu.table.search');
    Route::get('/patients', [PatientApiController::class, 'index'])->name('api.patients');

    // Posyandu record routes
    Route::post('/posyandu/store', [PosyanduApiController::class, "store"])->name('posyandu.store');
    Route::post('/posyandu/update', [PosyanduApiController::class, "update"])->name('posyandu.update');

    // Delete route
    Route::delete('/news/delete/{id}', [NewsApiController::class, "delete"])->name('api.news.delete');
    Route::delete('/activity/delete/{id}', [ActivityApiController::class, "delete"])->name('api.activity.delete');
});

Route::get('/news', [NewsApiController::class, "index"])->name('api.news.index');
Route::get('/activity', [ActivityApiController::class, "index"])->name('api.activity.index');
Route::get('/schedule', [ScheduleController::class, "getAll"])->name('api.schedule');
