<?php

namespace App\Http\Controllers;

use App\Models\bidang_minat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidangController extends Controller
{
    //
    public function add_bidang(Request $request){
        $bidang = $request->bidang;
        // cek apakah bidang sudah ada apa belum
        $cekBidang = bidang_minat::where("nama_bidang",'=',$bidang)->first();
        if($cekBidang == true){
            return back()->with(['error_add' => "Bidang sudah tersedia"]);
        }

        $updatebidang = DB::table("bidang_minats")->insert([
            "nama_bidang" => $bidang
        ]);
        if($updatebidang == true){
            return back()->with(['sukses_add' => "Berhasil menambah bidang"]);

        }else{
            return back()->with(['error_add' => "gagal menambah bidang"]);
        }
    }
    public function delete_bidang($id){
        if(session("role") != "admin"){
            return abort(403);
        }
        $deleteBidang = DB::table('bidang_minats')->where("id_bidang",'=',$id)->delete();
        if($deleteBidang == true){
            return back()->with(['sukses_delete' => "Berhasil menghapus bidang"]);

        }else{
            return back()->with(['error_delete' => "gagal menghapus bidang"]);
        }
    }
    public function edit_bidang(Request $request){
        if(session("role") != "admin"){
            return abort(403);
        }

        $id = $request->bidangs;
        $bidang = $request->bidang;
        // cek apakah bidang sudah ada apa belum
        $cekBidang = bidang_minat::where("nama_bidang",'=',$bidang)->where("id_bidang",'!=',$id)->first();
        if($cekBidang == true){
            return back()->with(['error_add' => "Bidang sudah tersedia"]);
        }

        $updatebidang = DB::table("bidang_minats")->where("id_bidang",'=',$id)->update([
            "nama_bidang" => $bidang
        ]);
        if($updatebidang == true){
            return back()->with(['sukses_add' => "Berhasil mengubah bidang"]);

        }else{
            return back()->with(['error_add' => "gagal mengubah bidang"]);
        }
    }
}