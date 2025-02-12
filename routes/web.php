<?php

use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRequestController;
use App\Models\Technician;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware('guest')->group(function () {

    Route::get('register', [UserController::class, 'showRegisterForm'])->name('auth.register.form');
    Route::post('register', [UserController::class, 'register'])->name('auth.register');


    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('auth.login.form');
    // Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserAuthController::class, 'authenticate'])->name('auth.login');

    Route::get('technician-login', [TechnicianController::class, 'showLoginForm'])->name('technician.login.form');
    Route::post('technician-login', [TechnicianController::class, 'authenticate'])->name('technician.login');

});


Route::middleware('anyRole')->group(function (){

    Route::prefix('dashboard')->group(function (){
        Route::get('', [DashboardController::class, 'returnDashboardView'])->name('dashboard');
        
    });

    Route::post('logout', [UserAuthController::class, 'logout'])->name('auth.logout');

});

Route::middleware('adminOnly')->group(function(){
    Route::post('technician-register', [TechnicianController::class, 'register'])->name('technician.register');
});


Route::middleware('UserOrAdmin')->group(function(){
    Route::get('create-request', [UserRequestController::class, 'showCreateForm'])->name('user.request.form');
    Route::post('create-request', [UserRequestController::class, 'createUserRequest'])->name('user.request.create');
});