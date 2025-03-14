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
        })->name('home');

        Route::controller(GradeController::class)->group(function () {
            Route::get('/grades', 'index')->name('grades.index');
            Route::get('/grades/create', 'create')->name('grades.create');
            Route::get('/grades/show/{id}', 'show')->name('grades.show');
            Route::get('/grades/edit/{id}', 'edit')->name('grades.edit');
        });

        Route::controller(StudentController::class)->group(function () {
            Route::get('/students', 'index')->name('students.index');
            Route::get('/students/create', 'create')->name('students.create');
            Route::get('/students/show/{id}', 'show')->name('students.show');
            Route::get('/students/edit/{id}', 'edit')->name('students.edit');
        });
    });
});
