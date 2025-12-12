<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\MedicationScheduleController;

// 1. Route Public (Tanpa Token)
Route::post('/login', [AuthController::class, 'login']);

// 2. Route Protected (Harus ada Token Pasien)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [App\Http\Controllers\Api\PatientController::class, 'me']);
    Route::post('/user/update', [ProfileController::class, 'update']);

    Route::get('/schedules', [MedicationScheduleController::class, 'index']);
    Route::post('/medication-logs', [App\Http\Controllers\Api\MedicationScheduleController::class, 'storeLog']);
    Route::patch('/schedules/{id}/toggle', [MedicationScheduleController::class, 'toggleStatus']);

    Route::get('/questions', [App\Http\Controllers\Api\QuestionnaireController::class, 'getQuestions']);
    Route::get('/check-questionnaire', [App\Http\Controllers\Api\QuestionnaireController::class, 'checkStatus']);
    Route::post('/answers', [App\Http\Controllers\Api\QuestionnaireController::class, 'submit']);

    Route::get('/contacts', [App\Http\Controllers\Api\TelenursingController::class, 'index']);

    Route::get('/educations', [App\Http\Controllers\Api\EducationController::class, 'index']);
    Route::post('/educations/{id}/view', [App\Http\Controllers\Api\EducationController::class, 'incrementView']);

    Route::post('/logout', [AuthController::class, 'logout']);

    // Nanti route jadwal, edukasi, dll taruh disini semua
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});
