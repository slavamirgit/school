<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('api.login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/grades', [GradeController::class, 'index'])->name('api.grades.index');
    Route::post('/grades/store', [GradeController::class, 'store'])->name('api.grades.store');
    Route::get('/grades/show/{id}', [GradeController::class, 'show'])->name('api.grades.show');
    Route::put('/grades/update/{id}', [GradeController::class, 'update'])->name('api.grades.update');
    Route::delete('/grades/delete/{id}', [GradeController::class, 'destroy'])->name('api.grades.delete');

    Route::get('/grades/students/{id}', [GradeController::class, 'getStudents'])->name('api.grades.students');

    Route::get('/students', [StudentController::class, 'index'])->name('api.students.index');
    Route::post('/students/store', [StudentController::class, 'store'])->name('api.students.store');
    Route::get('/students/show/{id}', [StudentController::class, 'show'])->name('api.students.show');
    Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('api.students.update');
    Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('api.students.delete');
});
