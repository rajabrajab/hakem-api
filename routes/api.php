<?php

use App\Http\Controllers\Api\v1\FamilyMembersController;
use App\Http\Controllers\Api\V1\PatientController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ############################  Auth Apis ############################ //

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::put('profile', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');

// ############################  Family Members Apis ############################ //

Route::resource('family-members', FamilyMembersController::class)->middleware('auth:sanctum');

Route::resource('patients', PatientController::class)->middleware('auth:sanctum');


