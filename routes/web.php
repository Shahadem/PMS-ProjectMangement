<?php

use Illuminate\Support\Facades\Route;

// Halaman Log In (Halaman Utama)
Route::get('/', function () {
    return view('login');
})->name('login');

// Route untuk Dashboard (Selepas Log In)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard.index');

// Route untuk Projects
Route::get('/projects', function () {
    return view('projects');
})->name('projects.index');

// Route untuk timeline
Route::get('/timeline', function () {
    return view('timeline');
})->name('timeline.index');

// Route untuk users
Route::get('/users', function () {
    return view('users');
})->name('users.index');

//Route untuk settings
Route::get('/settings', function () {
    return view('settings');
})->name('settings.index');


//route untuk logout
Route::get('/logout', function () {
    return view('logout');
})->name('logout.index');

//Route untuk usersindex
Route::get('/usersindex', function () {
    return view('usersindex');
})->name('usersindex.index');

//Route untuk rolesindex
Route::get('/rolesindex', function () {
    return view('rolesindex');
})->name('rolesindex.index');

//Route untuk permission module
Route::get('/permissionmodule', function () {
    return view('permissionmodule');
})->name('permissionmodule.index');

//Route untuk password
Route::get('/password', function () {
    return view('password');
})->name('password.index');

//Route untuk deleteaccount
Route::get('/deleteaccount', function () {
    return view('deleteaccount');
})->name('deleteaccount.index');

//Route untuk security
Route::get('/security', function () {
    return view('security');
})->name('security.index');


//Route untuk task_show
Route::get('/projects/task/{name}', function ($name) {
    return view('task_show', ['task_name' => $name]);
})->name('projects.task.show');