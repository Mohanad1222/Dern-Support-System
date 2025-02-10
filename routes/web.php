<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function(){

    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('auth.register.form');
    Route::post('/register', [UserController::class, 'register'])->name('auth.register');


    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');

});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

});
