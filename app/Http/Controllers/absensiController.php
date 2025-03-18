<?php

namespace App\Http\Controllers;

use App\Models\daftar_hadir;
use App\Models\instruktur;
use App\Models\jadwal;
use App\Models\kelas;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class absensiController extends Controller
{
    //
    public function mulaiKelas(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }

        $getKelas = kelas::select("k.id_kelas")
        ->from("kelas as k")
        ->join("instrukturs as i",'i.id_ins','=','k.id_ins')
        ->where("i.email_ins",'=',$email)
        ->first();

        //dd(Carbon::now()->toDateString());

        $updateStatus = DB::table("jadwals")
        ->where("id_kelas",'=',$getKelas->id_kelas)
        ->whereDate('tanggal_pelaksanaan', Carbon::now()->toDateString())
        ->update([
            "status" => "mulai"
        ]);
        if($updateStatus == true){
            return redirect('/view/absensi');
        }else{
            return back()->with(['error_start' => "Harap memilih jadwal dengan benar"]);
        }
    }

    public function viewListAbsenBerdasarTanggal($tgl){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        $getId = instruktur::where("email_ins",'=',$email)->first();
        
        $siswa = siswa::select('s.*')
        ->from("siswas as s")
        ->join("kelas as k", "k.id_kelas", "=", "s.id_kelas")
        ->where("k.id_ins", "=", $getId->id_ins)
        ->get();

        // Ambil daftar hadir berdasarkan tanggal pelaksanaan
        $getDaftarHadir = daftar_hadir::select('d.id_siswa', 'd.status_presensi')
            ->from("daftar_hadirs as d")
            ->join("jadwals as j", 'd.id_jadwal', '=', 'j.id_jadwal')
            ->join("kelas as k", 'k.id_kelas', '=', 'j.id_kelas')
            ->where("k.id_ins", '=', $getId->id_ins)
            ->where("j.tanggal_pelaksanaan", '=', $tgl)
            ->get();
            
        foreach ($siswa as $siswas) {
            $statusPresensi = $getDaftarHadir->where('id_siswa', $siswas->id_siswa)->first();
            $siswas->status_presensi = $statusPresensi ? $statusPresensi->status_presensi : 'Belum Absen';
        }
        
        Carbon::setLocale('id');
        $tanggal = Carbon::parse($tgl);
        $format_tanggal = $tanggal->translatedFormat('l, d F Y');
        if($getDaftarHadir->isEmpty()){
            return redirect('/view/absensi')->with(['tanggal_selected_format' => $format_tanggal, 'tanggal_selected' => $tanggal]);
        }else{
            //dd($siswa);
            return redirect('/view/absensi')->with(['listDaftarHadir' => $siswa,'tanggal_selected_format' => $format_tanggal, 'tanggal_selected' => $tanggal]);
        }
    }
    
    public function editAbsenAjax(Request $request)
    {
        $status = $request->status;
        $id_siswa = $request->id_siswa;
        $id_jadwal = $request->id_jadwal;
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        // Cek apakah siswa sudah terdaftar di daftar hadir
        $cekSiswa = daftar_hadir::where("id_siswa", $id_siswa)
                                ->where("id_jadwal", $id_jadwal)
                                ->first();
    
        if ($cekSiswa == true) {
            if ($cekSiswa->status_presensi !== $status) {
                $updateAbsen = DB::table("daftar_hadirs")
                                 ->where("id_presensi", $cekSiswa->id_presensi)
                                 ->update(["status_presensi" => $status]);
            
                if ($updateAbsen) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Siswa belum diabsenkan!'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Presensi siswa gagal diubah!'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Status sudah sesuai!'
                ]);
            }
            
        } else {
            $insertAbsen = DB::table("daftar_hadirs")->insert([
                "id_siswa" => $id_siswa,
                "status_presensi" => $status,
                "id_jadwal" => $id_jadwal
            ]);
    
            if ($insertAbsen == true) {
                return response()->json([
                    'success' => true,
                    'message' => 'Presensi siswa berhasil ditambahkan!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Presensi siswa gagal ditambahkan!'
                ]);
            }
        }
    }
    public function editAbsenSiswaAdminAjax(Request $request){
        $status = $request->status;
        $id_siswa = $request->id_siswa;
        $id_jadwal = $request->id_jadwal;
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        // Cek apakah siswa sudah terdaftar di daftar hadir
        $cekSiswa = daftar_hadir::where("id_siswa", $id_siswa)
                                ->where("id_jadwal", $id_jadwal)
                                ->first();
    
        if ($cekSiswa == true) {
            if ($cekSiswa->status_presensi !== $status) {
                $updateAbsen = DB::table("daftar_hadirs")
                                 ->where("id_presensi", $cekSiswa->id_presensi)
                                 ->update(["status_presensi" => $status]);
            
                if ($updateAbsen) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Presensi siswa berhasil diubah!'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Presensi siswa gagal diubah!'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Status sudah sesuai!'
                ]);
            }
            
        } else {
            $insertAbsen = DB::table("daftar_hadirs")->insert([
                "id_siswa" => $id_siswa,
                "status_presensi" => $status,
                "id_jadwal" => $id_jadwal
            ]);
    
            if ($insertAbsen == true) {
                return response()->json([
                    'success' => true,
                    'message' => 'Presensi siswa berhasil ditambahkan!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Presensi siswa gagal ditambahkan!'
                ]);
            }
        }
    }
    public function download_laporan_bulanan(Request $request)
    {
        $id_kelas = $request->selectKelas;
        $bulan = $request->selectBulan;
        $tahun = $request->selectTahun;
    
        // Tanggal pertama bulan tersebut
        $tanggal_awal = Carbon::create($tahun, $bulan, 1); 
        // Tanggal terakhir bulan tersebut
        $tanggal_akhir = $tanggal_awal->copy()->endOfMonth()->toDateString(); 
    
        $getDataJadwal = daftar_hadir::select("d.*", 's.nama', 'j.*')
        ->from("daftar_hadirs as d")
        ->join("siswas as s", 'd.id_siswa', '=', "s.id_siswa")
        ->join("jadwals as j", 'd.id_jadwal', '=', "j.id_jadwal")
        ->where("j.id_kelas", '=', $id_kelas)
        ->whereBetween("j.tanggal_pelaksanaan", [$tanggal_awal->toDateString(), $tanggal_akhir])
        ->get();
    
        // Urutkan data berdasarkan tanggal_pelaksanaan
        $getDataJadwal = $getDataJadwal->sortBy('tanggal_pelaksanaan');
        
        // Persiapkan data untuk Excel
        $excelData = [];
        
        // Header
        $excelData[] = ['LAPORAN KEHADIRAN BULANAN'];
        $excelData[] = ['BULAN', Carbon::createFromFormat('m', $bulan)->format('F')];
        $excelData[] = ['TAHUN', $tahun];
        
        // Kosongkan baris untuk pemisah
        $excelData[] = [];
        
        // Header kolom
        $excelData[] = ['TANGGAL','NAMA SISWA', 'STATUS KEHADIRAN'];
        
        // Jika data kosong, tampilkan pesan
        if ($getDataJadwal->isEmpty()) {
            $excelData[] = ['Tidak ada data untuk bulan ini'];
        } else {
            // Menambahkan data ke dalam array
            foreach ($getDataJadwal as $item) {
                // Tentukan status kehadiran
                $status_kehadiran = ($item->status_presensi == 'tidak_hadir') ? 'Tidak Hadir' : ucfirst($item->status_presensi);
                
                Carbon::setLocale('id'); 
                // Format tanggal menjadi format yang diinginkan
                $formattedDate = Carbon::parse($item->tanggal_pelaksanaan)->isoFormat('dddd, D MMMM YYYY');
            
                // Masukkan data ke array
                $excelData[] = [
                    $formattedDate,  // Tanggal dalam format: "Selasa, 4 Desember 2024"
                    $item->nama,     // Nama Siswa
                    $status_kehadiran, // Status Kehadiran
                ];
            }
        }
    
        // Download file Excel
        return Excel::download(new class($excelData) implements FromCollection, WithStyles, WithHeadings {
            protected $data;
    
            public function __construct($data)
            {
                $this->data = $data;
            }
    
            public function collection()
            {
                return collect($this->data);
            }
    
            public function headings(): array
            {
                return []; // Tidak ada headings karena kita sudah mendefinisikan header di data
            }
    
            public function styles($sheet)
            {
                // Mengatur style untuk baris tertentu
                return [
                    1    => ['font' => ['bold' => true]], // Bold untuk baris pertama (LAPORAN KEHADIRAN BULANAN)
                    2    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]], // Bold dan rata tengah untuk baris BULAN
                    3    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]], // Bold dan rata tengah untuk baris TAHUN
                    4    => ['font' => ['bold' => true]], // Bold untuk header kolom (NAMA SISWA, STATUS KEHADIRAN)
                    'A'  => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]], // Rata tengah kolom NAMA SISWA
                    'B'  => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]], // Rata tengah kolom STATUS KEHADIRAN
                ];
            }
        }, 'laporan_kehadiran_bulanan_' . $bulan . '_' . $tahun . '.xlsx');
    }
    public function generate_absen(Request $request){
        $email = session('email');
        $getIns = instruktur::where("email_ins", '=', $email)->first();
        $getKelas = kelas::where("id_ins", '=', $getIns->id_ins)->first();
        $getJadwal = jadwal::where("id_kelas",'=',$getKelas->id_kelas)->whereDate('tanggal_pelaksanaan', Carbon::now()->toDateString())->first();
        $encJadwal = Crypt::encryptString($getJadwal->id_jadwal);
    
        $safeEncJadwal = base64_encode($encJadwal);
        $url = url("scan/qr-code/absen/{$safeEncJadwal}");
        
        $uid = Carbon::now()->format('dmy');
        $nameFile = 'Qrcode_' . $getKelas->nama_kelas . '_' . $uid . '.svg';


        $qr = QrCode::format('svg')->size(300)->generate($url);
        $path = 'qrcode/absenQR/' . $nameFile;
        $moveStorage = file_put_contents(public_path('qrcode/absenQR/' . $nameFile), $qr);

        if($moveStorage){
            $updateQr = DB::table("jadwals")
            ->where("id_kelas",'=',$getKelas->id_kelas)
            ->whereDate('tanggal_pelaksanaan', Carbon::now()->toDateString())
            ->update([
                "qrcode_path" => "qrcode/absenQR/".$nameFile,
                "qrExpired_at" => Carbon::now()->addMinutes(15)->seconds(0)
            ]);
            if($updateQr == true){
                return back()->with(["sukses_generate" => "Berhasil membuat absensi QR"]);
            }else{
                File::delete(public_path($path));
                return back()->with(["eror_generate" => "Gagal membuat absensi QR"]);
            }
        }else{
            return back()->with(["eror_generate" => "Gagal membuat absensi QR"]);
        }
    }

    public function scan_absen($jadwal){
        $role = session("role");
        $email = session("email");
        if($role != "siswa"){
            return abort(403);
        }
        
        $siswa = Siswa::where("email", $email)->first();
        if (!$siswa) {
            return abort(404, "Siswa tidak ditemukan");
        }
        $decodedJadwal = base64_decode($jadwal);
        $id_jadwal = Crypt::decryptString($decodedJadwal);
        
        // cek apakah sudah absen
        $getabsen = daftar_hadir::where("id_siswa",'=',$siswa->id_siswa)->where('id_jadwal','=',$id_jadwal)->first();

        if($getabsen == false){
            $insertAbsen = DB::table("daftar_hadirs")->insert([
                "id_siswa" => $siswa->id_siswa,
                "status_presensi" => "hadir",
                "id_jadwal" => $id_jadwal
            ]);
    
            if($insertAbsen == true){
                return redirect('/view/absensi/siswa/'.$siswa->id_siswa)->with(["sukses_absen"=> "Absen Berhasil"]);
            }else{
                return redirect('/view/absensi/siswa/'.$siswa->id_siswa)->with(["error_absen"=> "Absen Gagal"]);
            }
        }else{
            return redirect('/view/absensi/siswa/'.$siswa->id_siswa)->with(["error_absen"=> "Telah Melakukan Absen"]);
        }
    }
}
