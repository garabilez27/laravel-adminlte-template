<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authorized;
use App\Http\Middleware\Guest;

use App\Http\Controllers\LoginController;

Route::middleware(Authorized::class)->group(function() {

});

Route::middleware(Guest::class)->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name('signin');
    Route::get('/add', [LoginController::class, 'add'])->name('signup');
    Route::get('/reset', [LoginController::class, 'reset'])->name('reset');
});
