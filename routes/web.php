<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Dashboard.dashboard');
});

// ============= Auth Route ==============
Route::match(['get','post'],'register',[AuthController::class,'register'])->name('register');
Route::match(['get','post'],'login',[AuthController::class,'login'])->name('login');
Route::match(['get','post'],'dashboard',[AuthController::class,'dashboard'])->name('dashboard');
Route::match(['get','post'],'logout',[AuthController::class,'logout'])->name('logout');
Route::match(['get','post'],'profile',[AuthController::class,'profile'])->name('profile');
