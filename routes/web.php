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

        Route::controller(GradeController::class)->group(function () {
            Route::get('/grades', 'index')->name('web.grades.index');
            Route::get('/grades/create', 'create')->name('web.grades.create');
            Route::get('/grades/show/{id}', 'show')->name('web.grades.show');
            Route::get('/grades/edit/{id}', 'edit')->name('web.grades.edit');
        });

        Route::controller(StudentController::class)->group(function () {
            Route::get('/students', 'index')->name('web.students.index');
            Route::get('/students/create', 'create')->name('web.students.create');
            Route::get('/students/show/{id}', 'show')->name('web.students.show');
            Route::get('/students/edit/{id}', 'edit')->name('web.students.edit');
        });
    });
});
