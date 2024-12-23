<?php

namespace App\Http\Controllers;

use App\Models\instruktur;
use App\Models\kelas;
use App\Models\kuis;
use App\Models\mapel;
use App\Models\nilai_kuis;
use App\Models\opsi_pg;
use App\Models\siswa;
use App\Models\soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class kuisController extends Controller
{
    //
    public function add_kuis(Request $request){
        $judul = $request->judulKuis;
        $mapel = $request->MapelKuis;
        if (trim($judul) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }

        $getJudul = kuis::where("judul_kuis",'=',$judul)->first();
        if($getJudul == true){
            return back()->with(["error_add" => "judul kuis sudah tersedia"]);
        }
        // cek apakah mapel udah ada kuis atau belom
        
        $getMapel = kuis::where("id_mapel",'=',$mapel)->first();
        if($getMapel == true){
            return back()->with(["error_add" => "Mapel sudah terdapat kuis"]);
        }

        $countKuis = kuis::count();
        
        $insertKuis = DB::table("kuis")->insert([
            "id_kuis" => "KUIS".$mapel. ($countKuis + 1),
            "id_mapel" => $mapel,
            "judul_kuis" => $judul,
        ]);

        if($insertKuis == true){
            return back()->with(["sukses_add" => "Berhasil Menambah Kuis"]);
        }else{
            return back()->with(["error_add" => "Gagal Menambah Kuis"]);
        }
    }

    public function delete_kuis($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        // klo kuisnya udah ada yang ngerjain brarti gabole dihapus
        $cekKuis = nilai_kuis::where("id_kuis",'=',$id)->first();
        if($cekKuis == true){
            return back()->with(["error_delete" => "Kuis Telah Dikerjakan Siswa"]);
        }
        // get soal yang terhubung dengan kuis
        $getSoal = soal::where("id_kuis",'=',$id)->get();

        foreach($getSoal as $item){
            //dd($item->type_soal);
            if($item->type_soal == "pilgan"){
                // get opsi yang terhubung dengan soal
                $getOpsi = opsi_pg::select("id_opsi")->where("id_soal",'=',$item->id_soal)->get();
                foreach($getOpsi as $items){
                    $deleteOpsi = DB::table("opsi_pgs")->where("id_opsi",'=',$items->id_opsi)->delete();
                }
                //menghapus jawaban benar dari soal terkait
                $deleteJawaban= DB::table("jawabans")->where("id_soal",'=',$item->id_soal)->delete();
                if($deleteJawaban == false){
                    return back()->with(["error_delete" => "Gagal Menghapus Kuis 1"]);
                }
            }
            $deleteSoal= DB::table("soals")->where("id_soal",'=',$item->id_soal)->delete();
            if($deleteSoal == false){
                return back()->with(["error_delete" => "Gagal Menghapus Kuis 2"]);
            }
        }
        $deleteKuis = DB::table("kuis")->where("id_kuis",'=',$id)->delete();
        if($deleteKuis == true){
            return back()->with(["sukses_delete" => "Berhasil Menghapus Kuis"]);
        }else{
            return back()->with(["error_delete" => "Gagal Menghapus Kuis 3"]);
        }
    }

    public function edit_kuis(Request $request){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        $id = $request->juduls;
        $judul = $request->judulKuisEdit;
        $mapel = $request->MapelKuisEdit;
        //dd($judul);
        // cek soal udah dikerjain apa belom
        $cekKerjain = nilai_kuis::where("id_kuis",'=',$id)->first();
        if($cekKerjain == true){
            return back()->with(["error_add" => "Kuis telah dikerjakan oleh siswa!"]);
        }
        if (trim($judul) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }

        // cek apakah mapel udah ada kuis apa blom
        $cekMapel = kuis::where("id_mapel",'=',$mapel)->where("id_kuis",'!=',$id)->first();
        if($cekMapel == true){
            return back()->with(["error_edit" => "Mapel sudah terdapat kuis"]);

        }
        $cekJudul = kuis::where("judul_kuis",'=',$judul)->where("id_kuis",'!=',$id)->first();
        //dd($cekJudul);
        if($cekJudul == true){
            return back()->with(["error_edit" => "judul kuis sudah tersedia"]);
        }

        $updatekuis = DB::table("kuis")->where("id_kuis",'=',$id)->update([
            "judul_kuis" => $judul,
            "id_mapel" => $mapel,
        ]);
        if($updatekuis == true){
            return back()->with(["sukses_edit" => "Berhasil mengubah Kuis"]);
        }else{
            return back()->with(["error_edit" => "Gagal mengubah Kuis"]);
        }
    }

    public function downloadLaporanKuis($id_kuis){

        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        $getIns = instruktur::where("email_ins",'=',$email)->first();
        
        // cek kalau masi ada nilai siswa yang blom fix, gabisa didownload
        $getKelas = kelas::where("id_ins",'=',$getIns->id_ins)->first();
        $getNamaKuis = kuis::where("id_kuis",'=',$id_kuis)->first();
        $cekNilai = nilai_kuis::select('nilai_kuis.*')
        ->join('siswas', 'siswas.id_siswa', '=', 'nilai_kuis.id_siswa') // Join dengan tabel siswas
        ->where('nilai_kuis.id_kuis', '=', $id_kuis)
        ->where('nilai_kuis.nilai_fix', '=', null)
        ->where('siswas.id_kelas', '=', $getKelas->id_kelas) // Filter siswa berdasarkan kelas
        ->first();


        if($cekNilai == true ){
            return back()->with(["error_edit" => "Terdapat nilai yang masih belum fix"]);
        }

        $cekNilai2 = nilai_kuis::where("id_kuis",'=',$id_kuis)->first();
        if($cekNilai2 == null){
            return back()->with(["error_edit" => "Kuis belum dikerjakan!"]);

        }
        // get data nilai kuis berdasar id kuis
        $getSiswa = DB::table('siswas')
        ->select('id_siswa', 'nama')
        ->where('id_kelas', '=', $getKelas->id_kelas)
        ->where('status', '=', "aktif")
        ->get();
    
        $getNilai = nilai_kuis::select('n.id_siswa', 'n.nilai_fix', 'k.judul_kuis')
            ->from('nilai_kuis as n')
            ->join('kuis as k', 'k.id_kuis', '=', 'n.id_kuis')
            ->where('n.id_kuis', '=', $id_kuis)
            ->get();
        
        // Proses gabungan data siswa dengan nilai kuis
        $excelData = [];
        $excelData[] = ['Nama Kuis', 'Nama Siswa', 'Nilai'];
        
        foreach ($getSiswa as $siswa) {
            $nilaiFix = 0; // Default nilai untuk siswa yang belum mengerjakan
            $judulKuis = $getNamaKuis->judul_kuis;
            
            // Cek apakah siswa ada di daftar nilai kuis
            foreach ($getNilai as $nilai) {
                if ($nilai->id_siswa == $siswa->id_siswa) {
                    $nilaiFix = $nilai->nilai_fix !== null ? $nilai->nilai_fix : 0;
                    $judulKuis = $nilai->judul_kuis;
                    break;
                }
            }
        
            // Tambahkan data ke array Excel
            $excelData[] = [
                $judulKuis ?? 'Belum Ada Kuis', // Nama kuis jika belum ada datanya
                $siswa->nama,
                (string)$nilaiFix
            ];
        }
        
        // Debug hasil
        //dd($excelData);
        
        // Download file Excel
        return Excel::download(new class($excelData) implements FromCollection {
            protected $data;
            
            public function __construct($data)
            {
                $this->data = $data;
            }

            public function collection()
            {
                return collect($this->data);
            }
        }, 'laporan_kuis_' . $getNamaKuis->judul_kuis . '.xlsx');
    }
    
}
