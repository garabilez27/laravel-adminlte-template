<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authorized;
use App\Http\Middleware\Guest;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubMenusController;

Route::middleware(Authorized::class)->group(function() {
    Route::get('/terminate', [LoginController::class, 'logout'])->name('signout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Roles
    Route::prefix('roles')->group(function() {
        Route::get('/', [RolesController::class, 'index'])->name('rl.index');
        Route::get('/add', [RolesController::class, 'add'])->name('rl.add');
        Route::get('{id}/edit', [RolesController::class, 'edit'])->name('rl.edit');
        Route::get('{id}/delete', [RolesController::class, 'destroy'])->name('rl.delete');

        Route::post('/create', [RolesController::class, 'create'])->name('rl.create');
        Route::post('/update', [RolesController::class, 'update'])->name('rl.update');
    });

    Route::prefix('settings')->group(function() {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');

        // Menus
        Route::prefix('menus')->group(function() {
            Route::get('/', [MenusController::class, 'index'])->name('mn.index');
            Route::get('/add', [MenusController::class, 'add'])->name('mn.add');
            Route::get('{id}/edit', [MenusController::class, 'edit'])->name('mn.edit');
            Route::get('{id}/delete', [MenusController::class, 'destroy'])->name('mn.delete');

            Route::post('/create', [MenusController::class, 'create'])->name('mn.create');
            Route::post('/update', [MenusController::class, 'update'])->name('mn.update');
        });

        // Sub Menus
        Route::prefix('subs')->group(function() {
            Route::get('/', [SubMenusController::class, 'index'])->name('sbmn.index');
            Route::get('/add', [SubMenusController::class, 'add'])->name('sbmn.add');
            Route::get('{id}/edit', [SubMenusController::class, 'edit'])->name('sbmn.edit');
            Route::get('{id}/delete', [SubMenusController::class, 'destroy'])->name('sbmn.delete');

            Route::post('/create', [SubMenusController::class, 'create'])->name('sbmn.create');
            Route::post('/update', [SubMenusController::class, 'update'])->name('sbmn.update');
        });
    });
});

Route::middleware(Guest::class)->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('signin');
    Route::get('/register', [LoginController::class, 'add'])->name('signup');
    Route::get('/reset', [LoginController::class, 'reset'])->name('reset');

    Route::post('/validate', [LoginController::class, 'validate'])->name('validate');
});
