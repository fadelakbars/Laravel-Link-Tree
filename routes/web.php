<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
    Route::post('/links/reorder', [LinkController::class, 'reorder'])->name('links.reorder');
    Route::post('/links/{link}/move-up', [LinkController::class, 'moveUp'])->name('links.move-up');
    Route::post('/links/{link}/move-down', [LinkController::class, 'moveDown'])->name('links.move-down');
    Route::put('/links/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::post('/password-resets/{passwordResetRequest}/resolve', [AdminUserController::class, 'resolvePasswordReset'])->name('password-resets.resolve');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::get('/{profile:slug}', PublicProfileController::class)->name('profiles.show');
