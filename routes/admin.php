<?php

use App\Http\Controllers\Admin\AdminAuthencationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminAuthencationController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginHandle')->name('login.handle');
    Route::get('forgot-password', 'forgotPassword')->name('forgot-password');
    Route::post('forgot-password', 'forgotPasswordHandle')->name('forgot-password.handle');
    Route::get('reset-password/{token}', 'resetPassword')->name('reset-password');
    Route::post('reset-password', 'resetPasswordHandle')->name('reset-password.handle');
});


Route::middleware('admin')->controller(AdminDashboardController::class)->group(function () {
    Route::get('/dashboard','index')->name('dashboard');
});