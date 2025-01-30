<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductcatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\UserRole;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');

    Route::middleware('guest')->group(function () {

        Route::view('/register', 'auth.register')->name('register');
        Route::post('/register', [AuthController::class, 'register']);

        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::resource('/products', ProductController::class);

    Route::middleware(['auth', UserRole::class . ':admin,editor'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('/productcats', ProductcatController::class);

        Route::middleware(UserRole::class . ':admin')->group(function () {
            Route::get('/users', [DashboardController::class, 'users'])->name('users');
        });
    });
});

Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return back();
})->name('set-locale');
