<?php

use App\Http\Controllers\Api\V1\DoctorsController;
use App\Http\Controllers\Api\v1\FamilyMembersController;
use App\Http\Controllers\Api\V1\FileController;
use App\Http\Controllers\Api\V1\PatientController;
use App\Http\Controllers\Api\V1\SpecialtiesController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//  Auth Apis  //

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::put('profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

////

Route::resource('family-members', FamilyMembersController::class)->middleware('auth:sanctum');

Route::resource('patients', PatientController::class)->middleware('auth:sanctum');

Route::resource('specialties', SpecialtiesController::class);

Route::resource('doctors', DoctorsController::class);
Route::put('doctors/clinic-information/{doctorId}', [DoctorsController::class,'updateClinicReservationInfo']);

Route::post('files/{folder}',[FileController::class, 'store' ]);

