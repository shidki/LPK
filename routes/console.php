<?php

use App\Models\instruktur;
use App\Models\jadwal;
use App\Models\kelas;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $cekTanggalSekarang = Carbon::now()->toDateString();

    
    // Ambil jadwal yang tanggalnya sebelum hari ini
    $getJadwal = DB::table('jadwals')
        ->where("tanggal_pelaksanaan", "<=", $cekTanggalSekarang)
        ->get();

    // Perbarui status jadwal menjadi "selesai"
    foreach ($getJadwal as $jadwal) {
        Log::info("Mengupdate jadwal ID: {$jadwal->id_jadwal} untuk tanggal {$cekTanggalSekarang} ");
        DB::table('jadwals')->where("id_jadwal", $jadwal->id_jadwal)->update([
            "status" => 'selesai'
        ]);
    }
})->dailyAt('17:00');

Schedule::call(function () {
    $cekTanggalSekarang = Carbon::now()->toDateString();

    // Ambil jadwal yang tanggalnya sama atau sebelum hari ini
    $getJadwal = DB::table('jadwals')
        ->where("tanggal_pelaksanaan", "=", $cekTanggalSekarang)
        ->get();
    
    if($getJadwal == true){
        foreach($getJadwal as $jadwal){
            if($jadwal->status == "mulai" || $jadwal->status == "selesai"){
                // Memeriksa siswa yang belum hadir pada jadwal tertentu
                $siswa = Siswa::get();
    
                // Ambil siswa yang sudah hadir
                $cekSiswa = DB::table('daftar_hadirs as d')
                    ->select("d.*", 's.nama', 'j.*')
                    ->join('jadwals as j', 'j.id_jadwal', '=', 'd.id_jadwal')
                    ->leftJoin('siswas as s', 's.id_siswa', '=', 'd.id_siswa')
                    ->where("j.tanggal_pelaksanaan", '=', $cekTanggalSekarang)
                    ->where("j.status", '!=', "libur")
                    ->get();
                
                // Ambil hanya id_siswa dari cekSiswa
                $cekSiswaIds = $cekSiswa->pluck('id_siswa');
                
                // Ambil siswa yang belum hadir
                $siswaTdkHadir = Siswa::whereNotIn('id_siswa', $cekSiswaIds)->get();
    
                foreach($siswaTdkHadir as $siswas){
                    // Ambil jadwal berdasarkan kelas siswa (misalnya berdasarkan kelas siswa atau kondisi lainnya)
                    $jadwalKelas = DB::table('jadwals')
                        ->where('id_kelas', '=', $siswas->id_kelas) // Pastikan ada kolom `id_kelas` pada tabel `siswas`
                        ->where("tanggal_pelaksanaan", "=", $cekTanggalSekarang)
                        ->first();
    
                    if ($jadwalKelas) {
                        // Insert hanya jika jadwal ditemukan
                        DB::table("daftar_hadirs")->insert([
                            "id_siswa" => $siswas->id_siswa,
                            "id_jadwal" => $jadwalKelas->id_jadwal,
                            "status_presensi" => "Alpha",
                        ]);
                        Log::info("Berhasil menambah jadwal {$jadwalKelas->id_jadwal} dan siswa {$siswas->id_siswa}");
                    } else {
                        Log::warning("Jadwal untuk kelas {$siswas->id_kelas} pada {$cekTanggalSekarang} tidak ditemukan.");
                    }
                }
            } else {
                Log::info("Status jadwal adalah aktif");
            }
        }
    }
})->dailyAt('17:00');

Schedule::call(function () {

    Artisan::call('jadwal:generate');
    Log::info('Jadwal generate command telah dijalankan.');
})->dailyAt('17:00');

Schedule::call(function () {
    Artisan::call('qr:clear-expired');
    Log::info('Hapus QR command telah dijalankan.');
})->everyMinute();