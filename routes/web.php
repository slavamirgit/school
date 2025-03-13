<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'welcome';
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

        Route::get('/grades', [GradeController::class, 'index'])->name('web.grades');

        Route::get('/students', function () {
            return view('site.students')->with('title', 'Students');
        })->name('web.students');
    });
});
