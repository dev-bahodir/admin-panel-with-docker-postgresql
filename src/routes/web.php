<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', fn () => redirect()->route('admin.users.index'));
        //Route::get('/', fn () => view('admin.index'))->name('dashboard');


        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('menus', MenuController::class);
    });

Route::post('/admin/menus', [MenuController::class, 'store'])
    ->name('admin.menus.store');

Route::get('admin/page/{slug}', function ($slug) {
    return view('admin.page', compact('slug'));
})->name('admin.page');
