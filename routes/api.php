<?php

use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/get/uploads', [FileController::class, "index"])->middleware('auth')->name('get.images');
Route::post('/uploads', [FileController::class, "store"])->middleware('auth')->name('upload');
