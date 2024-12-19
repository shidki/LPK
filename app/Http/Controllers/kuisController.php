<?php

namespace App\Http\Controllers;

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
        if (trim($judul) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
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
        // cek kalau masi ada nilai siswa yang blom fix, gabisa didownload
        $cekNilai = nilai_kuis::where("id_kuis",'=',$id_kuis)->where("nilai_fix",'=',null)->first();
        //dd($cekNilai);
        $getNamaKuis = kuis::where("id_kuis",'=',$id_kuis)->first();
        if($cekNilai == true ){
            return back()->with(["error_edit" => "Terdapat nilai yang masih belum fix"]);
        }
        if($cekNilai == null ){
            return back()->with(["error_edit" => "Belum ada siswa yang mengerjakan"]);
        }
        
        // get data nilai kuis berdasar id kuis
        $getNilai = nilai_kuis::select("n.*",'k.judul_kuis','s.nama')->from("nilai_kuis as n")
        ->join("kuis as k",'k.id_kuis','=','n.id_kuis')
        ->join("siswas as s",'s.id_siswa','=','n.id_siswa')
        ->where("n.id_kuis",'=',$id_kuis)->get();
        
        // Generate Excel langsung di Controller
        $excelData = [];
        // Tambahkan header
        $excelData[] = ['Nama Kuis', 'Nama Siswa', 'Nilai'];
        
        // Masukkan data nilai kuis
        foreach ($getNilai as $nilai) {
            $excelData[] = [
                $nilai->judul_kuis, 
                $nilai->nama, 
                $nilai->nilai_fix
            ];
        }
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
