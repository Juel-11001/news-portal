<?php

use App\Http\Controllers\Admin\AdminAuthencationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminAuthencationController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginHandle')->name('login.handle');
    Route::get('forgot-password', 'forgotPassword')->name('forgot-password');
    Route::post('forgot-password', 'forgotPasswordHandle')->name('forgot-password.handle');
    Route::get('reset-password/{token}', 'resetPassword')->name('reset-password');
    Route::post('reset-password', 'resetPasswordHandle')->name('reset-password.handle');
    Route::post('logout', 'destroy')->name('logout');
});


Route::group(['middleware' => 'admin'],function () {
    Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
    Route::put('profile-password-update/{id}', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::resource('profile', ProfileController::class);
});