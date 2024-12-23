<?php

namespace App\Http\Controllers;

use App\Models\bidang_minat;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidangController extends Controller
{
    //
    public function add_bidang(Request $request){
        $bidang = $request->bidang;
        if (trim($bidang) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        // cek apakah bidang sudah ada apa belum
        $cekBidang = bidang_minat::where("nama_bidang",'=',$bidang)->first();
        if($cekBidang == true){
            return back()->with(['error_add' => "Bidang sudah tersedia!"]);
        }

        $updatebidang = DB::table("bidang_minats")->insert([
            "nama_bidang" => $bidang
        ]);
        if($updatebidang == true){
            return back()->with(['sukses_add' => "Bidang berhasil ditambahkan!"]);

        }else{
            return back()->with(['error_add' => "Bidang gagal ditambahkan!"]);
        }
    }
    public function delete_bidang($id){
        if(session("role") != "admin"){
            return abort(403);
        }

        // cek bidang udah dipake apa belom
        $cekBidang = siswa::where('id_bidang','=',$id)->first();
        if($cekBidang == true){
            return back()->with(['error_delete' => "Bidang telah digunakan!"]);

        }
        $deleteBidang = DB::table('bidang_minats')->where("id_bidang",'=',$id)->delete();
        if($deleteBidang == true){
            return back()->with(['sukses_delete' => "Bidang berhasil dihapus!"]);

        }else{
            return back()->with(['error_delete' => "Bidang gagal dihapus!"]);
        }
    }
    public function edit_bidang(Request $request){
        if(session("role") != "admin"){
            return abort(403);
        }

        $id = $request->bidangs;
        $bidang = $request->bidang;
        if (trim($bidang) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        // cek apakah bidang sudah ada apa belum
        $cekBidang = bidang_minat::where("nama_bidang",'=',$bidang)->where("id_bidang",'!=',$id)->first();
        if($cekBidang == true){
            return back()->with(['error_add' => "Bidang sudah tersedia!"]);
        }

        $updatebidang = DB::table("bidang_minats")->where("id_bidang",'=',$id)->update([
            "nama_bidang" => $bidang
        ]);
        if($updatebidang == true){
            return back()->with(['sukses_add' => "Bidang berhasil diubah!"]);

        }else{
            return back()->with(['error_add' => "Bidang berhasil diubah!"]);
        }
    }
}
