<?php

use App\Http\Controllers\Api\PatientApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [PatientApiController::class, 'search'])->middleware('auth');
