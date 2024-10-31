<?php

use App\Http\Controllers\akunController;
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

// ========== edit profile ========
Route::post('/edit_siswa', [AuthController::class, 'edit_profile'])->name("edit_profile"); // edit profile oleh siswa

// ============= dashboard menu di awal ===========
Route::get('/halamanDashboard',[halamanController::class, 'dashboard'])->name('dashboard');

// ============= dashboard admin route ===========
Route::get('/halamanAdmin',[halamanController::class, 'dashboardAdmin'])->name('dashboardAdmin');
Route::get('/akunInstruktur',[halamanController::class, 'akunInstruktur'])->name('akunInstruktur');

// ====== profile route =====
    // ======== siswa =====
    Route::get('/dataSiswa',[halamanController::class, 'dataSiswa'])->name('dataSiswa');
    Route::get('/edit/profile/{id}',[halamanController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/add/siswa',[ProfileController::class, 'add_siswa'])->name('add_siswa');
    Route::get('/delete/siswa/{id}',[ProfileController::class, 'delete_siswa'])->name('delete_siswa');
    Route::post('/edit_siswa_admin', [ProfileController::class, 'edit_siswa_admin'])->name("edit_siswa_admin"); // edit profile oleh admin
    // ======== instruktur ======
    Route::get('/dataInstruktur',[halamanController::class, 'dataInstruktur'])->name('dataInstruktur');
    Route::post('/add/instruktur',[ProfileController::class, 'add_instruktur'])->name('add_instruktur');
    Route::get('/delete/instruktur/{id}',[ProfileController::class, 'delete_instruktur'])->name('delete_instruktur');
    Route::post('/edit/instruktur', [ProfileController::class, 'edit_instruktur'])->name("edit_instruktur"); // edit profile oleh siswa
    
    
// ========= AKUN ROUTE ================
Route::post('/add/akun',[akunController::class, 'add_akun'])->name('add_akun');
Route::get('/delete/akun/{id}',[akunController::class, 'delete_akun'])->name('delete_akun');



Route::get('/edit_siswa', function(){
    return view("auth.login.login");
});

