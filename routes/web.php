<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\PaymentController;
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

    //all dashboard view
    Route::prefix('dashboard')->group(function (){
        //main dashboard view
        Route::get('', [DashboardController::class, 'returnDashboardView'])->name('dashboard');

        //admin only dashboard views
        Route::middleware('adminOnly')->group(function(){
            Route::get('users/{user?}', [DashboardController::class, 'returnDashboardViewUsers'])->name('dashboard.users');
            Route::delete('users/delete/{user?}', [UserController::class, 'deleteUserAccount'])->name('users.delete');
            Route::get('technicians', [DashboardController::class, 'returnDashboardViewTechnicians'])->name('dashboard.technicians');
            Route::put('technicians/update/{technician}', [TechnicianController::class, 'updateTechnician'])->name('dashboard.technicians.update');
        });
        Route::middleware('technicianOrAdmin')->group(function(){
            Route::get('requests', [DashboardController::class, 'returnDashboardViewRequests'])->name('dashboard.requests');
            Route::put('request/update/{user_request}', [UserRequestController::class, 'updateUserRequest'])->name('requests.update');
            Route::get('devices', [DashboardController::class, 'returnDashboardViewDevices'])->name('dashboard.devices');
            Route::put('devices/update/{device}', [DeviceController::class, 'updateDeviceStatus'])->name('devices.update');
            Route::get('payments', [DashboardController::class, 'returnDashboardViewPayments'])->name('dashboard.payments');
            Route::put('payments/update/{payment}', [PaymentController::class, 'updatePayment'])->name('payments.update');
            Route::get('feedbacks', [DashboardController::class, 'returnDashboardViewFeedbacks'])->name('dashboard.feedbacks');
        });

        
    });

    Route::post('logout', [UserAuthController::class, 'logout'])->name('auth.logout');

});

Route::middleware('adminOnly')->group(function(){
    Route::post('technician-register', [TechnicianController::class, 'register'])->name('technician.register');
});


Route::middleware('UserOrAdmin')->group(function(){
    Route::post('create-request', [UserRequestController::class, 'createUserRequest'])->name('user.request.create');
});

