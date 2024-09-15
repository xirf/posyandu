<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\PosyanduTableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth')->group(function () {
    Route::get('/get/uploads', [FileController::class, "index"])->name('get.images');
    Route::post('/uploads', [FileController::class, "store"])->name('upload');
    Route::get('/posyandu/table', [PosyanduTableController::class, "index"])->name('posyandu.table');
});