<?php

namespace App\Http\Controllers;

use App\Models\kompNilai;
use App\Models\nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kompNilaiController extends Controller
{
    public function add_kompNilai(Request $request){
        $kompNilai = $request->kompNilai;
        $proporsi = $request->proporsi;
        $valueProporsi = $proporsi;
        if($proporsi == 0){
            return back()->with(["error_add" => "Proporsi tidak boleh 0"]);

        }
        if (trim($kompNilai) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }
        $cekKomp = kompNilai::where("nama_komp_nilai",'=',$kompNilai)->first();
        
        if($cekKomp == true){
            return back()->with(['error_add' => "Nama komponen nilai sudah tersedia"]);
        }

        // cek proporsi masi mumpuni atau engga
        $cekProporsi = kompNilai::get();
        $jmlProporsi = 0;
        foreach($cekProporsi as $item){
            $jmlProporsi = $jmlProporsi + $item->proporsi_nilai;
        }

        if($valueProporsi > (100 - $jmlProporsi)){
            return back()->with(['error_add' => "Bobot Nilai Tidak Memenuhi"]);
        }

        $insertKompNilai = DB::table("komp_nilais")->insert([
            "nama_komp_nilai" => $kompNilai,
            "proporsi_nilai" => $valueProporsi,
        ]);
        if($insertKompNilai == true){
            return back()->with(['sukses_add' => "Berhasil menambah komponen nilai"]);
        }else{
            return back()->with(['error_add' => "Gagal menambah komponen nilai"]);
        }
    }
    public function edit_kompNilai(Request $request){
        $kompNilais = $request->kompNilais;
        $kompNilai = $request->kompNilai;
        $proporsi = $request->proporsi;
        $valueProporsi = $proporsi;
        if($proporsi == 0){
            return back()->with(["error_add" => "Proporsi tidak boleh 0"]);

        }
        if (trim($kompNilai) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }
        // cek proporsi masi cukup atau engga
        $cekProporsi = kompNilai::get();
        $cekProporsiById = kompNilai::where('id_komp_nilai','=',$kompNilais)->first();
        $jmlProporsi = 0;
        foreach($cekProporsi as $item){
            $jmlProporsi = $jmlProporsi + $item->proporsi_nilai;
        }
        if($valueProporsi > (100 - ($jmlProporsi - $cekProporsiById->proporsi_nilai))){
            return back()->with(['error_add' => "Bobot Nilai Tidak Memenuhi"]);
        }


        $cekKomp = kompNilai::where("nama_komp_nilai",'=',$kompNilai)->where("id_komp_nilai",'!=',$kompNilais)->first();
        
        if($cekKomp == true){
            return back()->with(['error_add' => "Nama komponen nilai sudah tersedia"]);
        }

        $updateKompNilai = DB::table("komp_nilais")->where("id_komp_nilai",'=',$kompNilais)->update([
            "nama_komp_nilai" => $kompNilai,
            "proporsi_nilai" => $valueProporsi,
        ]);
        if($updateKompNilai == true){
            return back()->with(['sukses_add' => "Berhasil mengubah komponen nilai"]);
        }else{
            return back()->with(['error_add' => "Gagal mengubah komponen nilai"]);
        }
    }

    public function delete_kompNilai($id){
        // CEK APAKAH KOMPONEN NILAI UDAH DIPAKE APA BLOM
        $cekKomp = nilai::where("id_komp_nilai",'=',$id)->first();
        if($cekKomp == true){
            return back()->with(['error_delete' => "Komponen nilai telah digunakan"]);
            
        }

        $deleteKomp = DB::table("komp_nilais")->where("id_komp_nilai",'=',$id)->delete();
        if($deleteKomp == true){
            return back()->with(['sukses_add' => "Berhasil menghapus komponen nilai"]);
        }else{
            return back()->with(['error_add' => "Gagal menghapus komponen nilai"]);
        }
    }
}
