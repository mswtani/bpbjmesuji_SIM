<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPostController;


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
    | Content Management
    |--------------------------------------------------------------------------
    */

    Route::get('/posts', [PostController::class, 'index'])
        ->middleware('permission:posts.view')
        ->name('posts.index');

    Route::get('/posts/create', [PostController::class, 'create'])
        ->middleware('permission:posts.create')
        ->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])
        ->middleware('permission:posts.create')
        ->name('posts.store');

    Route::get(
        'posts/{post}/document/preview',
        [PostController::class, 'previewDocument']
    )->name('posts.document.preview');

    Route::get(
        'posts/{post}/document/download',
        [PostController::class, 'downloadDocument']
    )->name('posts.document.download');

    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->middleware('permission:posts.view')
        ->name('posts.show');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
        ->middleware('permission:posts.update')
        ->name('posts.edit');

    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->middleware('permission:posts.update')
        ->name('posts.update');

    Route::patch('/posts/{post}/publish', [PostController::class, 'publish'])
        ->middleware('permission:posts.publish')
        ->name('posts.publish');

    Route::patch('/posts/{post}/archive', [PostController::class, 'archive'])
        ->middleware('permission:posts.publish')
        ->name('posts.archive');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->middleware('permission:posts.delete')
        ->name('posts.destroy');

    /*
    |--------------------------------------------------------------------------
    | Relasi pdf
    |--------------------------------------------------------------------------
    */
    Route::post(
        'posts/{post}/relations',
        [PostController::class, 'storeRelation']
    )->name('posts.relations.store');

    Route::delete(
        'posts/{post}/relations/{relation}',
        [PostController::class, 'destroyRelation']
    )->name('posts.relations.destroy');


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
| Public Content
|--------------------------------------------------------------------------
*/

Route::get('/berita', [PublicPostController::class, 'news'])
    ->name('public.news');

Route::get('/berita/{slug}', [PublicPostController::class, 'newsShow'])
    ->name('public.news.show');

Route::get('/pengumuman', [PublicPostController::class, 'announcements'])
    ->name('public.announcements');

Route::get('/pengumuman/{slug}', [PublicPostController::class, 'announcementShow'])
    ->name('public.announcements.show');

Route::get('/regulasi', [PublicPostController::class, 'regulations'])
    ->name('public.regulations');

Route::get('/regulasi/{slug}', [PublicPostController::class, 'regulationShow'])
    ->name('public.regulations.show');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';