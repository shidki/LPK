<?php

namespace App\Http\Controllers;

use App\Models\kuis;
use App\Models\opsi_pg;
use App\Models\soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kuisController extends Controller
{
    //
    public function add_kuis(Request $request){
        $judul = $request->judulKuis;
        $mapel = $request->MapelKuis;

        $getJudul = kuis::where("judul_kuis",'=',$judul)->first();
        if($getJudul == true){
            return back()->with(["error_add" => "judul kuis sudah tersedia"]);
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
            }
            //menghapus jawaban benar dari soal terkait
            $deleteJawaban= DB::table("jawabans")->where("id_soal",'=',$item->id_soal)->delete();
            if($deleteJawaban == false){
                return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
            }
            $deleteSoal= DB::table("soals")->where("id_soal",'=',$item->id_soal)->delete();
            if($deleteSoal == false){
                return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
            }
        }
        $deleteKuis = DB::table("kuis")->where("id_kuis",'=',$id)->delete();
        if($deleteKuis == true){
            return back()->with(["sukses_delete" => "Berhasil Menghapus Kuis"]);
        }else{
            return back()->with(["error_delete" => "Gagal Menghapus Kuis"]);
        }
    }

    public function edit_kuis(Request $request){
        $id = $request->juduls;
        $judul = $request->judulKuisEdit;
        $mapel = $request->MapelKuisEdit;

        
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
}
