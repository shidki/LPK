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
use App\Http\Controllers\nilaiController;
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
Route::post('/edit_siswa', [AuthController::class, 'edit_profile'])->name("edit_profile_oleh_siswa"); // edit profile oleh siswa
Route::get('/edit_siswa', function(){
    return abort(403);
});
Route::post('/edit_ins', [AuthController::class, 'edit_profile_ins'])->name("edit_profile_oleh_ins"); // edit profile oleh ins
Route::get('/edit_ins', function(){
    return abort(403);
});
Route::post('/edit_adm', [AuthController::class, 'edit_profile_adm'])->name("edit_profile_oleh_adm"); // edit profile oleh adm
Route::get('/edit_adm', function(){
    return abort(403);
});
// ============= dashboard menu di awal ===========
Route::get('/halamanDashboard',[halamanController::class, 'dashboard'])->name('dashboard');
Route::get('/materiPembelajaran',[halamanController::class, 'materiPembelajaran'])->name('materiPembelajaran');
Route::get('/kuis',[halamanController::class, 'kuis'])->name('kuis');
Route::get('/review/kuis',[halamanController::class, 'review_kuis_siswa'])->name('review_kuis_siswa');
Route::get('/view/absensi',[halamanController::class, 'absensi'])->name('absensi');
Route::get('/view/penilaian',[halamanController::class, 'halaman_penilaian'])->name('halaman_penilaian');
Route::get('/view/transkip/{id}',[halamanController::class, 'halaman_transkip_siswa'])->name('halaman_transkip_siswa');
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
Route::get('/dataMateri',[halamanController::class, 'dataMateri'])->name('dataMateri');



// =========================================================================================================================================================================
// ====== profile route =====
    // ======== siswa =====
    Route::get('/edit/profile/siswa/{id}',[halamanController::class, 'edit_profile_siswa'])->name('edit_profile_siswa');
    Route::post('/add/siswa',[ProfileController::class, 'add_siswa'])->name('add_siswa');
    Route::get('/delete/siswa/{id}',[ProfileController::class, 'delete_siswa'])->name('delete_siswa');
    Route::post('/edit_siswa_admin', [ProfileController::class, 'edit_siswa_admin'])->name("edit_siswa_admin"); // edit profile oleh admin
    // ======== instruktur ======
    Route::get('/edit/profile/ins/{id}',[halamanController::class, 'edit_profile_ins'])->name('edit_profile_ins');
    Route::post('/add/instruktur',[ProfileController::class, 'add_instruktur'])->name('add_instruktur');
    Route::get('/delete/instruktur/{id}',[ProfileController::class, 'delete_instruktur'])->name('delete_instruktur');
    Route::post('/edit/instruktur', [ProfileController::class, 'edit_instruktur'])->name("edit_instruktur");
    
    // ======== admin ===========
    Route::get('/edit/profile/adm/{id}',[halamanController::class, 'edit_profile_adm'])->name('edit_profile_adm');
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
Route::get('/detail/kelas/{id}',[kelasController::class, 'detail_kelas'])->name('detail_kelas');

// ========= KOMPONEN NILAI ROUTE ==============
Route::post('/add/KompNilai',[kompNilaiController::class, 'add_kompNilai'])->name('add_kompNilai');
Route::post('/edit/kompNilai',[kompNilaiController::class, 'edit_kompNilai'])->name('edit_kompNilai');
Route::get('/delete/kompNilai/{id}',[kompNilaiController::class, 'delete_kompNilai'])->name('delete_kompNilai');

// ========= KOMPONEN MATERI ROUTE ==============
    // ============= MAPEL / BAB ===================
    Route::post('/add/mapel',[materiController::class, 'add_mapel'])->name('add_mapel');
    Route::post('/edit/mapel',[materiController::class, 'edit_mapel'])->name('edit_mapel');
    // ============= MATERI =============
    Route::post('/edit/materi',[materiController::class, 'edit_materi'])->name('edit_materi');
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



// ============ VIEW ABSEN SISWA ===========
Route::get('/view/absensi/siswa/{id}',[halamanController::class, 'viewAbsenSiswa'])->name('viewAbsenSiswa');
// ============ VIEW materi SISWA ===========
Route::get('/view/materi',[halamanController::class, 'viewMateri'])->name('viewMateri');
Route::get('/ubah_status_materi/{id_mapel}/{id_materi}',[materiController::class, 'ubah_status_materi'])->name('ubah_status_materi');



// =========== VIEW KUIS SISWA ==============
Route::get('/view/kuis',[halamanController::class, 'view_kuis_siswa'])->name('view_kuis_siswa');
Route::get('/kuis/{nama_mapel}/{id_kuis}',[soalController::class, 'viewSoal'])->name('viewSoal');
Route::post('/submit/kuis/{id_kuis}',[soalController::class, 'submitKuis'])->name('submitKuis');
Route::get('/review/kuis/{id}',[soalController::class, 'reviewKuis'])->name('reviewKuis');


// ============ REVIEW KUIS GURU ================
Route::get('/list/kuis/{id}',[halamanController::class, 'view_kuis_instruktur'])->name('view_kuis_instruktur');
Route::get('/list/kuis/admin/{id}',[halamanController::class, 'view_kuis_admin'])->name('view_kuis_admin');
Route::get('/review/kuis/{id}/{id_siswa}',[soalController::class, 'reviewKuis_siswa'])->name('reviewKuis_siswa');
Route::post('/edit/status_jawaban', [soalController::class, 'editStatusJawabanAjax']);
Route::post('/submit/koreksi/{id_kuis}/{id_siswa}',[soalController::class, 'submitKoreksi'])->name('submitKoreksi');
Route::get('/cancel/koreksi/{id_kuis}/{id_siswa}',[soalController::class, 'cancelKoreksi'])->name('cancelKoreksi');
Route::get('/download/laporan/kuis/{id}',[kuisController::class, 'downloadLaporanKuis'])->name('downloadLaporanKuis');

// ============ NILAI GURU ===================
Route::get('/get/nilai/{id}',[nilaiController::class, 'getNilaiModal'])->name('getNilaiModal');
Route::post('/edit/nilai',[nilaiController::class, 'edit_nilai_siswa'])->name('edit_nilai_siswa');


// ============ VIEW ABSEN SISWA OLEH ADMIN ===========
Route::get('/halaman/absensi',[halamanController::class, 'halamanAbsensiAdmin'])->name('halamanAbsensiAdmin');


Route::get('/halaman/absensi/{id}',[halamanController::class, 'halamanAbsensiAdminKelas'])->name('halamanAbsensiAdminKelas');
Route::get('/halaman/absensi/{id_kelas}/{tanggal}',[halamanController::class, 'halamanAbsensiAdminKelasTgl'])->name('halamanAbsensiAdminKelasTgl');
Route::post('/edit/absen/siswaAdmin', [absensiController::class, 'editAbsenSiswaAdminAjax']);

// ============ LAPORAN BULANAN ==================
Route::get('/laporan/bulanan',[halamanController::class, 'halamanLaporanBulanan'])->name('halamanLaporanBulanan');
Route::post('/download_laporan_bulanan',[absensiController::class, 'download_laporan_bulanan'])->name('download_laporan_bulanan');

// ================ EDIT JADWAL LIBUR ========
Route::get('/editstatus/libur/{id}',[jadwalController::class, 'jadwalLibur'])->name('jadwalLibur');
Route::get('/tambah/jadwal/{id}',[jadwalController::class, 'tambahJadwal'])->name('tambahJadwal');

// =============== TRANSKIP NILAI SISWA ===========
Route::get('/download/transkip/nilai/{id_siswa}', [nilaiController::class, 'downloadTranskip']);
Route::get('/view/transkip/nilai/{id_siswa}', [nilaiController::class, 'viewTranskip']);


// ================ ABSEN QR CODE ==================
Route::post('/generate/qr-code/absen', [absensiController::class,'generate_absen'])->name('generate_absen');
Route::get('/scan/absen/qr', [halamanController::class,'halaman_scan'])->name('halaman_scan');
Route::get('scan/qr-code/absen/{jadwal}', [absensiController::class,'scan_absen'])->name('scan_absen');