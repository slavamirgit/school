<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('api.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(GradeController::class)->group(function () {
        Route::get('/grades', 'index');
        Route::post('/grades/store', 'store');
        Route::get('/grades/show/{id}', 'show');
        Route::put('/grades/update/{id}', 'update');
        Route::delete('/grades/delete/{id}', 'destroy');

        Route::get('/grades/students/{id}', 'getStudents');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index');
        Route::post('/students/store', 'store');
        Route::get('/students/show/{id}', 'show');
        Route::put('/students/update/{id}', 'update');
        Route::delete('/students/delete/{id}', 'destroy');
    });
});
