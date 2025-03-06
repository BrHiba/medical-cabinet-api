<?php

use App\Http\Controllers\SpecialityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::apiResource('doctors', DoctorController::class);


Route::get('/specialities', [SpecialityController::class, 'index']);
Route::get('/specialities/{id}', [SpecialityController::class, 'show']);
Route::post('/specialities', [SpecialityController::class, 'store']);
Route::put('/specialities/{id}', [SpecialityController::class, 'update']);
Route::delete('/specialities/{id}', [SpecialityController::class, 'destroy']);



Route::get('/appointments', [AppointmentController::class, 'index']); // Liste des rendez-vous
Route::post('/appointments', [AppointmentController::class, 'store']); // Créer un rendez-vous
Route::get('/appointments/{id}', [AppointmentController::class, 'show']); // Voir un rendez-vous
Route::put('/appointments/{id}', [AppointmentController::class, 'update']); // Modifier un rendez-vous
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']); // Supprimer un rendez-vous
