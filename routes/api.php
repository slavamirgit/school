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
        Route::get('/grades', 'index')->name('api.grades.index');
        Route::post('/grades/store', 'store')->name('api.grades.store');
        Route::get('/grades/show/{id}', 'show')->name('api.grades.show');
        Route::put('/grades/update/{id}', 'update')->name('api.grades.update');
        Route::delete('/grades/delete/{id}', 'destroy')->name('api.grades.delete');

        Route::get('/grades/students/{id}', 'getStudents')->name('api.grades.students');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/students', 'index')->name('api.students.index');
        Route::post('/students/store', 'store')->name('api.students.store');
        Route::get('/students/show/{id}', 'show')->name('api.students.show');
        Route::put('/students/update/{id}', 'update')->name('api.students.update');
        Route::delete('/students/delete/{id}', 'destroy')->name('api.students.delete');
    });
});
