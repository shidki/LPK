<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kelasController extends Controller
{
    //
    public function add_kelas(Request $request){
        $kelas = $request->kelas;
        $kuota = $request->kuota;
        
        $cekKelas = kelas::where("nama_kelas",'=',$kelas)->first();
        
        if($cekKelas == true){
            return back()->with(['error_add' => "Nama kelas sudah tersedia"]);
        }

        $insertKelas = DB::table("kelas")->insert([
            "nama_kelas" => $kelas,
            "kuota_siswa" => $kuota,
        ]);
        if($insertKelas == true){
            return back()->with(['sukses_add' => "Berhasil menambah kelas"]);
        }else{
            return back()->with(['error_add' => "Gagal menambah kelas"]);
        }
    }

    public function edit_kelas(Request $request){
        $id = $request->kelass;
        $kelas = $request->kelas;
        $kuota = $request->kuota;
        $ins = $request->ins;

        $cekKelas = kelas::where("nama_kelas",'=',$kelas)->where("id_kelas",'!=',$id)->first();
        
        if($cekKelas == true){
            return back()->with(['error_add' => "Nama kelas sudah tersedia"]);
        }
        
        // mengecek jumlah siswa yang ada di kelas
        $cekSiswa = siswa::where("id_kelas",'=',$id)->count();
        if($kuota < $cekSiswa){
            return back()->with(['error_add' => "Kuota tidak boleh kurang dari jumlah siswa yang ada di kelas"]);
        }

        // dd($ins);
        $updateKelas = DB::table("kelas")->where("id_kelas",'=',$id)->update([
            "nama_kelas" => $kelas,
            "kuota_siswa" => $kuota,
            "id_ins" => $ins,
        ]);
        if($updateKelas == true){
            return back()->with(['sukses_add' => "Berhasil mengubah kelas"]);
        }else{
            return back()->with(['error_add' => "Gagal mengubah kelas"]);
        }
    }

    public function delete_kelas($id){
        // cek apakah ada siswa yang berada di kelas ini
        $cekSiswa = siswa::where("id_kelas",'=',$id)->first();
        if($cekSiswa == true){
            return back()->with(['error_delete' => "Terdapat Siswa"]);
        }

        $delete = DB::table('kelas')->where("id_kelas",'=',$id)->delete();
        if($delete == true){
            return back()->with(['sukses_delete' => "Berhasil menghapus kelas"]);
        }else{
            return back()->with(['error_delete' => "Berhasil menghapus kelas"]);
        }
    }
}
