<?php

namespace App\Http\Controllers;

use App\Models\kompNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kompNilaiController extends Controller
{
    public function add_kompNilai(Request $request){
        $kompNilai = $request->kompNilai;
        $proporsi = $request->proporsi;
        $valueProporsi = $proporsi / 100;
        // dd($valueProporsi);
        $cekKomp = kompNilai::where("nama_komp_nilai",'=',$kompNilai)->first();
        
        if($cekKomp == true){
            return back()->with(['error_add' => "Nama komponen nilai sudah tersedia"]);
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
        $valueProporsi = $proporsi / 100;
        // dd($valueProporsi);
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
        // TO DO : MELAKUKAN PENGECEKAN APAKAH KOMPONEN NILAI SEDANG DIGUNAKAN PADA NILAI SISWA ATAU TIDAK 
        // ( UTK SEMENTARA BLUMD DIBUAT KARNA BLM ADA TABEL NILAI)
        // ============================================================

        $deleteKomp = DB::table("komp_nilais")->where("id_komp_nilai",'=',$id)->delete();
        if($deleteKomp == true){
            return back()->with(['sukses_add' => "Berhasil menghapus komponen nilai"]);
        }else{
            return back()->with(['error_add' => "Gagal menghapus komponen nilai"]);
        }
    }
}
