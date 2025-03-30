<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\ExamSchedulingController;
use App\Http\Controllers\MedicController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', [AuthController::class, 'me'])->name('auth.me');
    Route::get('/check-availability/{date}/{time}', [ExamSchedulingController::class, 'checkAvailability']);
    Route::resource('clients', ClientController::class)->except(['create', 'edit']);
    Route::resource('exams', ExamController::class)->except(['create', 'edit']);
    Route::resource('exam-results', ExamResultController::class)->except(['create', 'edit']);
    Route::resource('exam-schedulings', ExamSchedulingController::class)->except(['create', 'edit']);
    Route::resource('medics', MedicController::class)->except(['create', 'edit']);
});

