<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ClearExpiredQrCodes extends Command
{
    protected $signature = 'qr:clear-expired';
    protected $description = 'Menghapus QR code yang sudah expired dan mengosongkan path di database';

    public function handle()
    {
        // Ambil data QR Code yang sudah expired
        $expiredQrs = DB::table('jadwals')
            ->whereNotNull('qrExpired_at')
            ->where('qrExpired_at', '<', Carbon::now())
            ->get();

        foreach ($expiredQrs as $qr) {
            // Path file QR Code
            $filePath = public_path($qr->qrcode_path);

            // Hapus file jika ada
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // Update database, set qrcode_path menjadi null
            DB::table('jadwals')
                ->where('id_kelas', $qr->id_kelas)
                ->update([
                    'qrcode_path' => null,
                    'qrExpired_at' => null,
                ]);
        }

        $this->info('Expired QR Codes berhasil dihapus.');
    }
}
