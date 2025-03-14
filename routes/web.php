<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('site.welcome')->with('title', 'Welcome');
});

Route::get('/users', function () {
    $users = \App\Models\User::all()->pluck('email');

    foreach ($users as $user) {
        echo '<div>' . $user . '</div>';
    }
});

Route::middleware('auth:sanctum')->group(function () {
    // Profile route should be available without verification

    Route::middleware('verified')->group(function () {
        Route::get('/home', function () {
            return view('site.home')->with('title', 'Home');
        })->name('web.home');

        Route::get('/grades', [GradeController::class, 'index'])->name('web.grades.index');
        Route::get('/grades/create', [GradeController::class, 'create'])->name('web.grades.create');
        Route::get('/grades/show/{id}', [GradeController::class, 'show'])->name('web.grades.show');
        Route::get('/grades/edit/{id}', [GradeController::class, 'edit'])->name('web.grades.edit');

        Route::get('/students', [StudentController::class, 'index'])->name('web.students.index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('web.students.create');
        Route::get('/students/show/{id}', [StudentController::class, 'show'])->name('web.students.show');
        Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('web.students.edit');
    });
});
