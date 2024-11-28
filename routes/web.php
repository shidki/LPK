<?php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\akunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\kompNilaiController;
use App\Http\Controllers\kuisController;
use App\Http\Controllers\materiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\soalController;
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

// =========================================================================================================================================================================

// ========== edit profile ========
Route::post('/edit_siswa', [AuthController::class, 'edit_profile'])->name("edit_profile"); // edit profile oleh siswa
Route::get('/edit_siswa', function(){
    return abort(403);
});
// ============= dashboard menu di awal ===========
Route::get('/halamanDashboard',[halamanController::class, 'dashboard'])->name('dashboard');
Route::get('/materiPembelajaran',[halamanController::class, 'materiPembelajaran'])->name('materiPembelajaran');
Route::get('/kuis',[halamanController::class, 'kuis'])->name('kuis');
Route::get('/view/absensi',[halamanController::class, 'absensi'])->name('absensi');
// ============== view soal kuis ===================
Route::get('/view/soal/{id}',[halamanController::class, 'view_soal'])->name('view_soal');


// ============= dashboard sidebar route ===========
Route::get('/halamanAdmin',[halamanController::class, 'dashboardAdmin'])->name('dashboardAdmin');

Route::get('/akunSiswa',[halamanController::class, 'akunSiswa'])->name('akunSiswa');
Route::get('/akunInstruktur',[halamanController::class, 'akunInstruktur'])->name('akunInstruktur');
Route::get('/akunAdmin',[halamanController::class, 'akunAdmin'])->name('akunAdmin');

Route::get('/dataBidang',[halamanController::class, 'dataBidang'])->name('dataBidang');

Route::get('/dataSiswa',[halamanController::class, 'dataSiswa'])->name('dataSiswa');
Route::get('/dataInstruktur',[halamanController::class, 'dataInstruktur'])->name('dataInstruktur');
Route::get('/dataAdmin',[halamanController::class, 'dataAdmin'])->name('dataAdmin');
Route::get('/dataKelas',[halamanController::class, 'dataKelas'])->name('dataKelas');

Route::get('/dataKompNilai',[halamanController::class, 'dataKompNilai'])->name('dataKompNilai');



// =========================================================================================================================================================================
// ====== profile route =====
    // ======== siswa =====
    Route::get('/edit/profile/{id}',[halamanController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/add/siswa',[ProfileController::class, 'add_siswa'])->name('add_siswa');
    Route::get('/delete/siswa/{id}',[ProfileController::class, 'delete_siswa'])->name('delete_siswa');
    Route::post('/edit_siswa_admin', [ProfileController::class, 'edit_siswa_admin'])->name("edit_siswa_admin"); // edit profile oleh admin
    // ======== instruktur ======
   
    Route::post('/add/instruktur',[ProfileController::class, 'add_instruktur'])->name('add_instruktur');
    Route::get('/delete/instruktur/{id}',[ProfileController::class, 'delete_instruktur'])->name('delete_instruktur');
    Route::post('/edit/instruktur', [ProfileController::class, 'edit_instruktur'])->name("edit_instruktur");
    
    // ======== admin ===========
    Route::post('/add/admin',[ProfileController::class, 'add_admin'])->name('add_admin');
    Route::get('/delete/admin/{id}',[ProfileController::class, 'delete_admin'])->name('delete_admin');
    Route::post('/edit/admin', [ProfileController::class, 'edit_admin'])->name("edit_admin");


// =========================================================================================================================================================================

// ========= AKUN ROUTE ================
    // ============== INSTRUKTUR ============
    Route::post('/add/akun/instruktur',[akunController::class, 'add_akun_instruktur'])->name('add_akun_instruktur');
    Route::post('/edit/akun/instruktur',[akunController::class, 'edit_akun_instruktur'])->name('edit_akun_instruktur');
    Route::post('/edit/status/akun/instruktur',[akunController::class, 'edit_status_akun_instruktur'])->name('edit_status_akun_instruktur');
    Route::get('/delete/akun/instruktur/{id}',[akunController::class, 'delete_akun_instruktur'])->name('delete_akun_instruktur');
    // ============== ADMIN ============
    Route::post('/add/akun/admin',[akunController::class, 'add_akun_admin'])->name('add_akun_admin');
    Route::post('/edit/akun/admin',[akunController::class, 'edit_akun_admin'])->name('edit_akun_admin');
    Route::post('/edit/status/akun/admin',[akunController::class, 'edit_status_akun_admin'])->name('edit_status_akun_admin');
    Route::get('/delete/akun/admin/{id}',[akunController::class, 'delete_akun_admin'])->name('delete_akun_admin');
    // ============== SISWA ============
    Route::post('/add/akun/siswa',[akunController::class, 'add_akun_siswa'])->name('add_akun_siswa');
    Route::post('/edit/akun/siswa',[akunController::class, 'edit_akun_siswa'])->name('edit_akun_siswa');
    Route::post('/edit/status/akun/siswa',[akunController::class, 'edit_status_akun_siswa'])->name('edit_status_akun_siswa');
    Route::get('/delete/akun/siswa/{id}',[akunController::class, 'delete_akun_siswa'])->name('delete_akun_siswa');



// =========================================================================================================================================================================

// ========= BIDANG ROUTE ==============
Route::post('/add/bidang',[BidangController::class, 'add_bidang'])->name('add_bidang');
Route::post('/edit/bidang',[BidangController::class, 'edit_bidang'])->name('edit_bidang');
Route::get('/delete/bidang/{id}',[BidangController::class, 'delete_bidang'])->name('delete_bidang');

// ========= KELAS ROUTE ==============
Route::post('/add/kelas',[kelasController::class, 'add_kelas'])->name('add_kelas');
Route::post('/edit/kelas',[kelasController::class, 'edit_kelas'])->name('edit_kelas');
Route::get('/delete/kelas/{id}',[kelasController::class, 'delete_kelas'])->name('delete_kelas');

// ========= KOMPONEN NILAI ROUTE ==============
Route::post('/add/KompNilai',[kompNilaiController::class, 'add_kompNilai'])->name('add_kompNilai');
Route::post('/edit/kompNilai',[kompNilaiController::class, 'edit_kompNilai'])->name('edit_kompNilai');
Route::get('/delete/kompNilai/{id}',[kompNilaiController::class, 'delete_kompNilai'])->name('delete_kompNilai');

// ========= KOMPONEN MATERI ROUTE ==============
    // ============= MAPEL / BAB ===================
    Route::post('/add/mapel',[materiController::class, 'add_mapel'])->name('add_mapel');
    Route::post('/edit/mapel',[materiController::class, 'edit_mapel'])->name('edit_mapel');
    // ============= MATERI =============
    Route::get('/delete/mapel/{id}',[materiController::class, 'delete_mapel'])->name('delete_mapel');
    Route::get('/delete/materi/{id}',[materiController::class, 'delete_materi'])->name('delete_materi');

// ========= KOMPONEN KUIS ROUTE ==============
Route::post('/add/kuis',[kuisController::class, 'add_kuis'])->name('add_kuis');
Route::post('/edit/kuis',[kuisController::class, 'edit_kuis'])->name('edit_kuis');
Route::get('/delete/kuis/{id}',[kuisController::class, 'delete_kuis'])->name('delete_kuis');

// ==========  KELOLA SOAL ============
Route::post('/add/soal',[soalController::class, 'add_soal'])->name('add_soal');
Route::get('/delete/soal/{id}',[soalController::class, 'delete_soal'])->name('delete_soal');
Route::post('/edit/soal',[soalController::class, 'edit_soal'])->name('edit_soal');
Route::post('/edit/opsi',[soalController::class, 'edit_opsi'])->name('edit_opsi');
Route::post('/edit/jawabanBenar',[soalController::class, 'edit_jawabanBenar'])->name('edit_jawabanBenar');



// ==========  KELOLA JADWAL ============
Route::get('/view/jadwal/{nama}',[jadwalController::class, 'view_jadwal'])->name('view_jadwal');

// ==========  KELOLA ABSENSI ============
Route::get('/mulaiKelas',[absensiController::class, 'mulaikelas'])->name('mulaikelas');
Route::get('/view/absen/siswa/{tgl}',[absensiController::class, 'viewListAbsenBerdasarTanggal'])->name('viewListAbsenBerdasarTanggal');
//Route::get('/edit/absen/siswa/{status}/{id_siswa}/{id_jadwal}', [absensiController::class, 'editAbsen']);
Route::post('/edit/absen/siswa', [absensiController::class, 'editAbsenAjax']);
