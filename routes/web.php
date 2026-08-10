<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware([
        'auth',
        'verified',
        'password-changed',
    ])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Change Password
    |--------------------------------------------------------------------------
    */

    Route::get('/change-password', [ChangePasswordController::class, 'edit'])
        ->name('password.change');

    Route::put('/change-password', [ChangePasswordController::class, 'update'])
        ->name('password.change.update');


    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index'])
        ->middleware('permission:users.view')
        ->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->middleware('permission:users.create')
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware('permission:users.create')
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->middleware('permission:users.update')
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->middleware('permission:users.update')
        ->name('users.update');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->middleware('permission:users.view')
        ->name('users.show');

    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])
        ->middleware('permission:users.activate')
        ->name('users.activate');

    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])
        ->middleware('permission:users.deactivate')
        ->name('users.deactivate');

    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->middleware('permission:users.reset-password')
        ->name('users.reset-password');


    /*
    |--------------------------------------------------------------------------
    | Role Management
    |--------------------------------------------------------------------------
    */

    Route::get('/roles', [RoleController::class, 'index'])
        ->middleware('permission:roles.view')
        ->name('roles.index');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->middleware('permission:roles.create')
        ->name('roles.create');

    Route::post('/roles', [RoleController::class, 'store'])
        ->middleware('permission:roles.create')
        ->name('roles.store');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->middleware('permission:roles.update')
        ->name('roles.edit');

    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->middleware('permission:roles.update')
        ->name('roles.update');

    Route::get('/roles/{role}/permissions', [RoleController::class, 'permissions'])
        ->middleware('permission:roles.update')
        ->name('roles.permissions');

    Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
        ->middleware('permission:roles.update')
        ->name('roles.permissions.update');

    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->middleware('permission:roles.delete')
        ->name('roles.destroy');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';