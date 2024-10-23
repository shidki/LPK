<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    
    public function add_siswa(Request $request){
        $nama = $request->nama_siswa;
        $email = $request->email;
        $nohp = $request->nohp;
        $alamat = $request->alamat;
        $kelas = $request->kelas_siswa;
        $bidang = $request->bidang_siswa;
        $tglMasuk = $request->tglMasuk;
        $status = $request->status_siswa;

        // dd($status);
        $cekEmail = siswa::select("email")->where("email",'=',$email)->first();
        $ceknohp = siswa::select("no_hp")->where("no_hp",'=',$nohp)->first();
        // email tersedia
        if($cekEmail == true){
            return back()->with(["error_add" => "Email tersedia"]);
        }
        if($ceknohp){
            return back()->with(["error_add" => "No hp tersedia"]);
        }

        // ==== menentukan id siswa ====
        $cekCountSiswa = siswa::count();

        $insertData = DB::table("siswas")->insert([
            "id_siswa" => "Siswa".$cekCountSiswa + 1,
            "nama" => $nama,
            "email" => $email,
            "no_hp" => $nohp,
            "alamat" => $alamat,
            "tgl_masuk" => $tglMasuk,
            "id_kelas" => $kelas,
            "id_bidang" => $bidang,
            "status" => $status,
        ]);
        if($insertData == true){
            return back()->with(["sukses_add" => "Siswa berhasil ditambah"]);

        }else{
            return back()->with(["sukses_add" => "Siswa gagal ditambah"]);
        }
    }

    public function delete_siswa($id){
        $role = session("role");
        if($role != "admin"){
            return back();
        }
        // dd($id);
        $deleteSiswa = DB::table('siswas')->where('id_siswa','=', $id)->delete();
        if($deleteSiswa == true){
            return back()->with(['sukses_delete' => "berhasil menghapus siswa"]);
        }else{
            return back()->with(['error_delete' => "gagal menghapus siswa"]);
        }
    }
}
