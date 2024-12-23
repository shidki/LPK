<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateJadwal extends Command
{
    protected $signature = 'jadwal:generate';
    protected $description = 'Generate jadwal satu tahun ke depan dari tanggal terakhir jadwal kelas';

    public function handle()
    {
        // Ambil semua kelas
        $kelas = Kelas::all();
        
        foreach ($kelas as $kelasItem) {
            // Ambil tanggal terakhir dari jadwal kelas
            $lastScheduleDate = Jadwal::where('id_kelas', $kelasItem->id_kelas)
                                      ->orderByDesc('tanggal_pelaksanaan')
                                      ->first();
            
            // Pastikan jadwal kelas ada
            if ($lastScheduleDate) {
                $lastDate = Carbon::parse($lastScheduleDate->tanggal_pelaksanaan);
                $currentDate = Carbon::now();

                //// cek apakah tanggal udah tersedia apa belom
                //$lastScheduleDate2 = $lastDate->copy()->addDay();
                //$cekJadwal = jadwal::where("tanggal_pelaksanaan",'=',$lastDate)->first();
                //if($cekJadwal == true){
                //    Log::info('Jadwal telah tersedia untuk kelas: ' . $kelasItem->nama_kelas);
                //    Log::info('cek tanggal: ' . $lastScheduleDate2);
                //}

                // Periksa apakah sekarang berada dalam rentang 1 hari sebelum tanggal terakhir
                if ($currentDate->greaterThanOrEqualTo($lastDate->subDay()) && $currentDate->lessThanOrEqualTo($lastDate)) {
        
                    $this->info('Menambahkan jadwal baru untuk kelas: ' . $kelasItem->nama_kelas);
                    Log::info('Menambahkan jadwal baru untuk kelas: ' . $kelasItem->nama_kelas);
                    
                    // Set tanggal mulai (besok setelah tanggal terakhir)
                    $currentDate = $lastDate->addDay();

                    // Set tanggal akhir (1 tahun ke depan)
                    $endDate = $currentDate->copy()->addYear();

                    // Data jadwal yang akan ditambahkan
                    $data = [];
                    
                    while ($currentDate->lte($endDate)) {
                        // Cek apakah hari ini Senin-Jumat
                        if ($currentDate->isWeekday()) {
                            $data[] = [
                                'id_jadwal' => 'JDWL' . $currentDate->format('y') . $currentDate->format('m') . $currentDate->format('d') . $kelasItem->id_kelas,
                                'id_kelas' => $kelasItem->id_kelas,
                                'tanggal_pelaksanaan' => $currentDate->format('Y-m-d'),
                                'status' => 'aktif', // Status jadwal
                            ];
                        }
                        // Tambahkan 1 hari
                        $currentDate->addDay();
                    }

                    // Masukkan data jadwal baru ke database
                    $insertJadwal = DB::table('jadwals')->insert($data);
                    $this->info('Jadwal baru telah ditambahkan untuk kelas: ' . $kelasItem->nama_kelas);
                    Log::info('Jadwal baru telah ditambahkan untuk kelas: ' . $kelasItem->nama_kelas);

                } else {
                    $this->info('Tidak perlu menambahkan jadwal baru untuk kelas: ' . $kelasItem->nama_kelas);
                    Log::info('Tidak perlu menambahkan jadwal baru untuk kelas: ' . $kelasItem->nama_kelas);
                }
            }
        }
    }
}
