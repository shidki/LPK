<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class, 'loginCounter'])->name('loginCounter');


// ============= Auth Route ==============
Route::post('/confirmLogin',[AuthController::class, 'login'])->name('masuk');
Route::post('/daftar',[AuthController::class, 'register'])->name('daftar');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/resetSandi',[AuthController::class, 'HalamanResetSandi'])->name('HalamanResetSandi');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password2', [AuthController::class, 'resetPassword2'])->name('reset.password2');
Route::post('/confirmResetPassword', [AuthController::class, 'confirmResetPassword'])->name('confirmResetPassword');

// ============= dashboard route ===========
Route::get('/halamanDashboard',[halamanController::class, 'dashboard'])->name('dashboard');

// ============= dashboard route ===========
Route::get('/halamanAdmin',[halamanController::class, 'dashboardAdmin'])->name('dashboardAdmin');
Route::get('/akunSiswa',[halamanController::class, 'akunSiswa'])->name('akunSiswa');

// ====== profile route =====
Route::get('/dataSiswa',[halamanController::class, 'dataSiswa'])->name('dataSiswa');
Route::post('/add/siswa',[ProfileController::class, 'add_siswa'])->name('add_siswa');
Route::get('/delete/siswa/{id}',[ProfileController::class, 'delete_siswa'])->name('delete_siswa');

