<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\Auth\LoginController;

// Temporary routes for forgot password and register
Route::get('/forgot-password', function () {
    return 'Forgot Password page – implement later';
})->name('forgotpassword.index');

Route::get('/register', function () {
    return 'Register page – implement later';
})->name('register.index');

// Temporary routes for timeline, projects, users, and settings
Route::middleware('auth')->group(function () {
    Route::get('/timeline', function () {
        return view('timeline');
    })->name('timeline.index');

    Route::get('/projects', function () {
        return view('projects');
    })->name('projects.index');

    Route::get('/users', function () {
        return view('users');
    })->name('users.index');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings.index');

    // Additional routes for settings sub-pages
    Route::get('/settings/security', function () {
        return view('security');
    })->name('security.index');

    Route::get('/settings/password', function () {
        return view('password');
    })->name('password.index');

    Route::get('/settings/delete-account', function () {
        return view('deleteaccount');
    })->name('deleteaccount.index');

    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');

    // User management routes
    Route::get('/users-list', function () {
        return view('usersindex');
    })->name('usersindex.index');

    Route::get('/roles', function () {
        return view('rolesindex');
    })->name('rolesindex.index');

    Route::get('/permissions', function () {
        return view('permissionmodule');
    })->name('permissionmodule.index');

    // Security setup route
    Route::get('/security-setup', function () {
        return view('security_setup');
    })->name('security_setup.index');

    // Task routes
    Route::get('/projects/task/{name}', function ($name) {
        return view('task_show');
    })->name('projects.task.show');
});