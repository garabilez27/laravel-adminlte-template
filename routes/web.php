<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authorized;
use App\Http\Middleware\Guest;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubMenusController;

Route::middleware(Authorized::class)->group(function() {
    Route::get('/terminate', [LoginController::class, 'logout'])->name('signout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('settings')->group(function() {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');

        Route::prefix('menus')->group(function() {
            Route::get('/', [MenusController::class, 'index'])->name('mn.index');
            Route::get('/add', [MenusController::class, 'add'])->name('mn.add');
        });

        Route::prefix('subs')->group(function() {
            Route::get('/', [SubMenusController::class, 'index'])->name('sbmn.index');
        });
    });
});

Route::middleware(Guest::class)->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('signin');
    Route::get('/register', [LoginController::class, 'add'])->name('signup');
    Route::get('/reset', [LoginController::class, 'reset'])->name('reset');

    Route::post('/validate', [LoginController::class, 'validate'])->name('validate');
});
