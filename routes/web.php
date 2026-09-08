<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicHelpdeskController;
use App\Http\Controllers\PublicHomeController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\RegulationTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicAccountController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicHomeController::class, 'index'])
    ->name('public.home');

Route::get('/pencarian', [PublicPostController::class, 'search'])
    ->name('public.search');

Route::get('/profil', [PublicProfileController::class, 'index'])
    ->name('public.profile');

Route::get('/kontak', function () {
    return view('public.contact');
    })->name('public.contact');
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
    'approved',
    'password-changed',
    'not-public',
])
->name('dashboard');


/*
|--------------------------------------------------------------------------
| Public Regulation Documents
|--------------------------------------------------------------------------
|
| Preview dan download dokumen regulasi harus dapat
| diakses oleh masyarakat tanpa login.
|
*/
Route::get(
    'posts/{post}/document/preview',
    [PostController::class, 'previewDocument']
)->name('posts.document.preview');

Route::get(
    'posts/{post}/document/download',
    [PostController::class, 'downloadDocument']
)->name('posts.document.download');
/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public User Account
    |--------------------------------------------------------------------------
    */

    Route::get('/akun', [PublicAccountController::class, 'edit'])
        ->name('public.account.edit');

    Route::patch('/akun', [PublicAccountController::class, 'update'])
        ->name('public.account.update');


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

    });


Route::middleware(['auth','approved',])->group(function () {
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
    | User Approval
    |--------------------------------------------------------------------------
    */

    Route::get('/users/approvals', [UserApprovalController::class, 'index'])
        ->middleware('permission:users.approve')
        ->name('users.approvals.index');

    Route::patch('/users/{user}/approve', [UserApprovalController::class, 'approve'])
        ->middleware('permission:users.approve')
        ->name('users.approve');

    Route::patch('/users/{user}/reject', [UserApprovalController::class, 'reject'])
        ->middleware('permission:users.reject')
        ->name('users.reject');

         /*
    |--------------------------------------------------------------------------
    | Helpdesk
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/helpdesk-admin',
        [HelpdeskController::class, 'index']
        )->middleware('permission:helpdesk.view')
        ->name('helpdesk.admin.index');

    Route::get(
        '/helpdesk-admin/tiket/{ticketNumber}',
        [HelpdeskController::class, 'show']
        )->middleware('permission:helpdesk.view')
        ->name('helpdesk.admin.show');

    Route::patch(
        '/helpdesk-admin/tiket/{ticketNumber}/kelola',
        [HelpdeskController::class, 'updateTicket']
        )->middleware('permission:helpdesk.manage')
        ->name('helpdesk.admin.ticket.update');

    Route::post(
        '/helpdesk-admin/tiket/{ticketNumber}/balas',
        [HelpdeskController::class, 'reply']
        )->middleware('permission:helpdesk.reply')
        ->name('helpdesk.admin.reply');

    Route::patch(
        '/helpdesk-admin/tiket/{ticketNumber}/pesan/{message}',
        [HelpdeskController::class, 'updateMessage']
        )->middleware('permission:helpdesk.manage')
        ->name('helpdesk.admin.message.update');

    Route::delete(
        '/helpdesk-admin/tiket/{ticketNumber}/pesan/{message}',
        [HelpdeskController::class, 'deleteMessage']
        )->middleware('permission:helpdesk.manage')
        ->name('helpdesk.admin.message.delete');

    Route::get(
        '/helpdesk-admin/tiket/{ticketNumber}/attachment/{attachment}/view',
        [HelpdeskController::class, 'viewAttachment']
        )->middleware('permission:helpdesk.view')
        ->name('helpdesk.admin.attachment.view');

    Route::get(
        '/helpdesk-admin/tiket/{ticketNumber}/attachment/{attachment}/download',
        [HelpdeskController::class, 'downloadAttachment']
        )->middleware('permission:helpdesk.view')
        ->name('helpdesk.admin.attachment.download');



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
        ->middleware('permission:posts.archive')
        ->name('posts.archive');

    Route::patch('/posts/{post}/restore', [PostController::class, 'restore'])
        ->middleware('permission:posts.restore')
        ->name('posts.restore');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->middleware('permission:posts.delete')
        ->name('posts.destroy');

    Route::resource('carousels', CarouselController::class)
        ->except(['show'])
        ->middleware([
            'index' => 'permission:carousels.view',
            'create' => 'permission:carousels.create',
            'store' => 'permission:carousels.create',
            'edit' => 'permission:carousels.update',
            'update' => 'permission:carousels.update',
            'destroy' => 'permission:carousels.delete',
        ]);

        /*
    |--------------------------------------------------------------------------
    | Regulation Type Management
    |--------------------------------------------------------------------------
    */
    
    Route::get(
        '/regulation-types/check-position',
        [RegulationTypeController::class, 'checkPosition']
        )
            ->middleware('permission:regulation-types.view')
            ->name('regulation-types.check-position');

    Route::get(
        '/regulation-types',
        [RegulationTypeController::class, 'index']
    )
        ->middleware('permission:regulation-types.view')
        ->name('regulation-types.index');

    Route::get(
        '/regulation-types/create',
        [RegulationTypeController::class, 'create']
    )
        ->middleware('permission:regulation-types.create')
        ->name('regulation-types.create');

    Route::post(
        '/regulation-types',
        [RegulationTypeController::class, 'store']
    )
        ->middleware('permission:regulation-types.create')
        ->name('regulation-types.store');

    Route::get(
        '/regulation-types/{regulationType}/edit',
        [RegulationTypeController::class, 'edit']
    )
        ->middleware('permission:regulation-types.update')
        ->name('regulation-types.edit');

    Route::put(
        '/regulation-types/{regulationType}',
        [RegulationTypeController::class, 'update']
    )
        ->middleware('permission:regulation-types.update')
        ->name('regulation-types.update');

    Route::get(
        '/regulation-types/{regulationType}',
        [RegulationTypeController::class, 'show']
    )
        ->middleware('permission:regulation-types.view')
        ->name('regulation-types.show');

    Route::delete(
        '/regulation-types/{regulationType}',
        [RegulationTypeController::class, 'destroy']
    )
        ->middleware('permission:regulation-types.delete')
        ->name('regulation-types.destroy');
    /*
    |--------------------------------------------------------------------------
    | Relasi pdf
    |--------------------------------------------------------------------------
    */
    Route::post(
        'posts/{post}/relations',
        [PostController::class, 'storeRelation']
    )
        ->middleware('permission:posts.update')
        ->name('posts.relations.store');

    Route::delete(
        'posts/{post}/relations/{relation}',
        [PostController::class, 'destroyRelation']
    )
        ->middleware('permission:posts.update')
        ->name('posts.relations.destroy');


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

// Route::get('/pengumuman', [PublicPostController::class, 'announcements'])
//     ->name('public.announcements');

// Route::get('/pengumuman/{slug}', [PublicPostController::class, 'announcementShow'])
//     ->name('public.announcements.show');

Route::get('/regulasi', [PublicPostController::class, 'regulations'])
    ->name('public.regulations');

Route::get('/regulasi/{slug}', [PublicPostController::class, 'regulationShow'])
    ->name('public.regulations.show');



/*
|--------------------------------------------------------------------------
| Public Helpdesk
|--------------------------------------------------------------------------
*/

Route::get(
        '/helpdesk',
        [PublicHelpdeskController::class, 'index']
    )->name('helpdesk.index');

Route::get(
        '/helpdesk/{slug}',
        [PublicHelpdeskController::class, 'create']
    )->name('helpdesk.create');

Route::post(
    '/helpdesk/{slug}',
    [PublicHelpdeskController::class, 'store']
    )->name('helpdesk.store');

Route::get(
    '/helpdesk/tiket/{ticketNumber}',
    [PublicHelpdeskController::class, 'showTicket']
    )->name('helpdesk.ticket');

Route::post(
    '/helpdesk/tiket/{ticketNumber}/messages',
    [PublicHelpdeskController::class, 'storeMessage']
    )->name('helpdesk.ticket.messages.store');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';