<?php

use App\Http\Controllers\Api\PatientApiController;
use App\Http\Controllers\Api\MedicalRecordApiController;
use App\Http\Controllers\MedicalRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/patients', [PatientApiController::class, 'search'])->name('api.patients');
    Route::get('/medical-records', [MedicalRecordController::class, 'getTable'])->name('api.medical.records');
    Route::post('/medical-records', [MedicalRecordApiController::class, 'store'])->name('api.new.medical.records'); 
});