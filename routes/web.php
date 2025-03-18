<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductcatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\UserRole;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('home');

    Route::get('/produk', [PublicController::class, 'product'])->name('product');
    Route::get('/blog', [PublicController::class, 'blog'])->name('blog');
    Route::get('/{user}/blog', [PublicController::class, 'userBlogs'])->name('userBlogs');

    Route::middleware('guest')->group(function () {

        Route::view('/register', 'auth.register')->name('register');
        Route::post('/register', [AuthController::class, 'register']);

        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [AuthController::class, 'login']);

        // forgot password
        Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
        Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
    });

    Route::resource('/products', ProductController::class);
    Route::resource('/blogs', BlogController::class);

    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // email verification notice route
        Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

        // email verification route
        Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

        // email verification resend route
        Route::post('/email/verification-notification', [AuthController::class, 'resendVerifyEmail'])->middleware('throttle:6,1')->name('verification.send');


        Route::middleware(UserRole::class . ':admin,editor')->group(function () {

            Route::resource('/productcats', ProductcatController::class);

            Route::middleware(UserRole::class . ':admin')->group(function () {
                Route::get('/users', [DashboardController::class, 'users'])->name('users');
            });
        });
    });
});

Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' =>  $locale]);
    return back();
})->name('set-locale');
