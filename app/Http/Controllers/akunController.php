<?php

namespace App\Http\Controllers;

use App\Models\instruktur;
use App\Models\siswa;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class akunController extends Controller
{
    //
    public function add_akun(Request $request){
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        $role = $request->role;

        if(session('role') != "admin"){
            return back();
        }

        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai"]);
        }

        // cek apakah email sudah digunakan atau belum
        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        if($cekEmail == true  || $cekEmail1 == true){
            return back()->with(["error_add" => "Email sudah tersedia"]);
        }
        //  cek apakah email yang didaftar udah kedaftar di table instruktur atau belum
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        if($cekEmailIns == false){
            // email ga dipake oleh instuktur manapun
            return back()->with(["error_add" => "Email tidak terdaftar pada instruktur"]);
        }


        $addAkun = DB::table("users")->insert([
            "email" => $email,
            "password" => $password,
            "role" => $role,
        ]);
        

        if($addAkun == true){
            // get id yang barusan ditambah
            $getId = DB::table("users")->where("email",'=',$email)->first();
            if($role == "instruktur"){
                // update id akun pada instruktur yang emailnya didaftarin
                $updateIdAkun = DB::table("instrukturs")->where("email_ins",'=',$email)->update([
                    "id_akun" => $getId->id_akun
                ]);
                if($updateIdAkun == true){
                    return back()->with(["sukses_add" => "Berhasil menambah akun instruktur"]); 
                }else{
                    return back()->with(["Gagal menambah akun instruktur"]);
                }
            }
        }
    }
    
    
    public function delete_akun($id){
        $role = session("role");
        if($role != "admin"){
            return back();
        }
        
        // get role dari aku nyang ingin dihapus
        $getRole = users::where("id_akun",'=',$id)->first();
        if($getRole->role == "siswa"){
            // mencari siswa yang menggunakan email tersebut
            $getSiswa = siswa::where("email",'=',$getRole->email)->first();
            // mengupdate id akun pada siswa tersebut
            $updateAkun = DB::table("siswas")->where("id_siswa",'=',$getSiswa->id_siswa)->update([
                "id_akun" => ""
            ]);
            if($updateAkun == true){
                $deleteAkun = users::where("id_akun",'=',$id)->delete();
                if($deleteAkun){
                    return back()->with(["sukses_delete" => "berhasil menghapus akun siswa"]);
                }else{
                    return back()->with(["error_delete" => "gagal menghapus akun siswa"]);
                }
            }else{
                return back()->with(["error_delete" => "gagal menghapus akun siswa"]);
            }
        }else{
            if($getRole->role == "instruktur"){
                // mencari instruktur yang menggunakan email tersebut
                $getIns = instruktur::where("email_ins",'=',$getRole->email)->first();
                // mengupdate id akun pada Ins tersebut
                $updateAkun = DB::table("instrukturs")->where("id_ins",'=',$getIns->id_ins)->update([
                    "id_akun" => null
                ]);

                
                if($updateAkun == true){
                    $deleteAkun = DB::table("users")->where("id_akun",'=',$id)->delete();
                    
                    if($deleteAkun){
                        return back()->with(["sukses_delete" => "berhasil menghapus akun instruktur"]);
                    }else{
                        return back()->with(["error_delete" => "gagal menghapus akun instruktur"]);
                    }
                }else{
                    return back()->with(["error_delete" => "gagal menghapus akun instruktur"]);
                }
            }else{
                // cek akun yang dihapus tuh akun yang sedang dipakai sekarang atau bukan
                // get email dlu
                $getEmail = users::where("id_akun",'=',$id)->first();
                if($getEmail->email == session("email")){
                    return back()->with(["error_delete" => "Tidak bisa menghapus akun sendiri"]);
                }
                $deleteAkun = users::where("id_akun",'=',$id)->delete();
                if($deleteAkun){
                    return back()->with(["sukses_delete" => "berhasil menghapus akun Admin"]);
                }else{
                    return back()->with(["error_delete" => "gagal menghapus akun Admin"]);
                }
            }
        }
    }
}
