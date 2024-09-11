<?php

use App\Http\Controllers\Api\PatientApiController;
use App\Http\Controllers\MedicalRecordController;
use App\Models\MedicalRecordModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:sanctum');

Route::get('/users', [PatientApiController::class, 'search'])->middleware('auth');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/medical-records', [MedicalRecordController::class, 'getTable'])->name('api.medical.records');
});