<?php

namespace App\Http\Controllers;

use App\Models\daftar_hadir;
use App\Models\instruktur;
use App\Models\jadwal;
use App\Models\kelas;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        ->join("instrukturs as i",'i.id_ins','=','k.id_ins')->first();

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
            //dd($getDaftarHadir);

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
                        'message' => 'Berhasil mengubah absen siswa'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengubah absen siswa (Tidak ada perubahan)'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Status sudah sesuai'
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
                    'message' => 'Berhasil menambahkan absen siswa'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan absen siswa 333'
                ]);
            }
        }
    }
    
}
