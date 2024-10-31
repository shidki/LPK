<?php

namespace App\Http\Controllers;

use App\Models\instruktur;
use App\Models\siswa;
use App\Models\users;
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
        $ceknohp = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$nohp)->first();
        $ceknohpIns = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$nohp)->first();


        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();
        
        // dd($cekEmailIns);
        // cek email di table users ( udah ke register apa blom)
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();
        
        // dd($cekEmail);
        // email tersedia
        if($cekEmail == true || $cekEmailIns == true || $cekEmail1 == true){
            return back()->with(["error_add" => "Email tersedia"]);
        }
        if($ceknohp == true ||  $ceknohpIns == true ){
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
        // getEmail yang dipake siswa sesuai id siswa
        $getEmail = DB::table("siswas")->select("email")->where('id_siswa','=', $id)->first();
        $deleteSiswa = DB::table('siswas')->where('id_siswa','=', $id)->delete();
        if($deleteSiswa == true){
            //  menghapus data siswa tpi emailnya blm kedaftar di table users alias siswanya blm daftar emailnya
            $getAkun = DB::table('users')->where('email','=', $getEmail->email)->first();
            // klo akun nya ktmu di table users brarti email yagn ada di table users juga dihapus
            if($getAkun == true){
                $deleteEmail = DB::table('users')->where('email','=', $getEmail->email)->delete();
                if($deleteEmail == true){
                    return back()->with(['sukses_delete' => "berhasil menghapus siswa"]);
                }else{
                    return back()->with(['error_delete' => "gagal menghapus akun siswa"]);
                }
            }else{
                // ini ketika delete siswa nya berhasil tpi email blm kedaftar
                return back()->with(['sukses_delete' => "berhasil menghapus siswa"]);
            }
            
        }else{
            return back()->with(['error_delete' => "gagal menghapus siswa"]);
        }
    }

    public function edit_siswa_admin(Request $request){
        $id = $request->siswas;
        $nama = $request->nama_siswaEdit;
        $email = $request->emailEdit;
        $no_hp = $request->nohpEdit;
        $alamat = $request->alamatEdit;
        $id_bidang = $request->bidang_siswaEdit;
        $id_kelas = $request->kelas_siswaEdit;
        $status = $request->status_siswaEdit;


        // query dibawah adlah digunakan untuk menyimpan data email sebelumnya ( untuk update data akun ketika email yang dimasukkan adalah email baru)
        $getEmailSiswa = DB::table("siswas")->where("id_siswa",'=',$id)->first();

        // cek email apakah email baru sudah digunakan
        // get data email
        $getEmail = DB::table("siswas")->where("email",'=',$email)->where("id_siswa",'!=',$id)->first();
        $getEmail1 = DB::table("users")->where("email",'=',$email)->first();
        $getEmail2 = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        if($getEmail == true || $getEmail1 == true || $getEmail2 == true){
            return back()->with(["error_edit" => "email sudah digunakan"]);
        }
        
        // cek no hp apakah no hp baru sudah digunakan
        // get data no hp
        $getNoHp = DB::table("siswas")->where("no_hp",'=',$no_hp)->where("id_siswa",'!=',$id)->first();
        if($getNoHp == true){
            return back()->with(["error_edit" => "No hp sudah digunakan"]);
        }

        // edit data siswa
        $updateSiswa = DB::table("siswas")->where("id_siswa",'=',$id)->update([
            "nama" => $nama,
            "email" => $email,
            "no_hp" => $no_hp,
            "alamat" => $alamat,
            "id_bidang" => $id_bidang,
            "id_kelas" => $id_kelas,
            "status" => $status,
        ]);

        if($updateSiswa == true){
            // jika data email yang dimasukkan adlah email baru maka akan di edit, jika sama , brarti tidak di edit

  
            if($getEmailSiswa->email != $email){
                // kondis  jika email yang dimasukkan berubah atau email baru
                $updateEmail = DB::table("users")->where("email",'=',$getEmailSiswa->email)->update([
                    "email" => $email
                ]);

                if($updateEmail == true){
                    return back()->with(["sukses_edit" => "Berhasil mengubah data siswa"]);
                }
            }
            return back()->with(["sukses_edit" => "Berhasil mengubah data siswa"]);
        }else{
            return back()->with(["error_edit" => "Gagal mengubah data siswa"]);
        }
    }

    // ==================== INSTUKTUR ============================
    public function add_instruktur(Request $request){
        $nama = $request->nama;
        $email = $request->email;
        $nohp = $request->nohp;
        $alamat = $request->alamat;
        $tglMasuk = $request->tglMasuk;

        // dd($status);
        $cekEmail = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $ceknohp = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$nohp)->first();
        $cekEmailSiswa = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $ceknohpSiswa = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$nohp)->first();

        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        
        // dd($cekEmail);
        // email tersedia
        if($cekEmail == true || $cekEmailSiswa == true || $cekEmail1 == true){
            return back()->with(["error_add" => "Email tersedia"]);
        }
        if($ceknohp == true ||  $ceknohpSiswa == true ){
            return back()->with(["error_add" => "No hp tersedia"]);
        }

        // ==== menentukan id siswa ====
        $cekCountIns = instruktur::count();

        $insertData = DB::table("instrukturs")->insert([
            "id_ins" => "Ins".$cekCountIns + 1,
            "nama_ins" => $nama,
            "email_ins" => $email,
            "no_hp_ins" => $nohp,
            "alamat_ins" => $alamat,
            "tgl_masuk_ins" => $tglMasuk,
        ]);
        if($insertData == true){
            return back()->with(["sukses_add" => "instruktur berhasil ditambah"]);

        }else{
            return back()->with(["sukses_add" => "instruktur gagal ditambah"]);
        }
    }

    public function delete_instruktur($id){
        $role = session("role");
        if($role != "admin"){
            return back();
        }
        // dd($id);
        // getEmail yang dipake instruktur sesuai id instruktur
        $getEmail = DB::table("instrukturs")->select("email_ins")->where('id_ins','=', $id)->first();
        $deleteSiswa = DB::table('instrukturs')->where('id_ins','=', $id)->delete();
        if($deleteSiswa == true){
            //  menghapus data siswa tpi emailnya blm kedaftar di table users alias siswanya blm daftar emailnya
            $getAkun = DB::table('users')->where('email','=', $getEmail->email_ins)->first();
            // klo akun nya ktmu di table users brarti email yagn ada di table users juga dihapus
            if($getAkun == true){
                $deleteEmail = DB::table('users')->where('email','=', $getEmail->email_ins)->delete();
                if($deleteEmail == true){
                    return back()->with(['sukses_delete' => "berhasil menghapus instruktur"]);
                }else{
                    return back()->with(['error_delete' => "gagal menghapus akun instruktur"]);
                }
            }else{
                // ini ketika delete instruktur nya berhasil tpi email blm kedaftar
                return back()->with(['sukses_delete' => "berhasil menghapus instruktur"]);
            }
            
        }else{
            return back()->with(['error_delete' => "gagal menghapus instruktur"]);
        }
    }
    public function edit_instruktur(Request $request){
        $id = $request->instrukturs;
        $nama = $request->namaEdit;
        $email = $request->emailEdit;
        $no_hp = $request->nohpEdit;
        $alamat = $request->alamatEdit;


        // query dibawah adlah digunakan untuk menyimpan data email sebelumnya ( untuk update data akun ketika email yang dimasukkan adalah email baru)
        $getEmailIns = DB::table("instrukturs")->where("id_ins",'=',$id)->first();

        // cek email apakah email baru sudah digunakan
        // get data email
        $getEmail = DB::table("instrukturs")->where("email_ins",'=',$email)->where("id_ins",'!=',$id)->first();
        $getEmail1 = DB::table("users")->where("email",'=',$email)->first();
        $cekEmailSiswa = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();

        if($getEmail == true || $getEmail1 == true || $cekEmailSiswa == true){
            return back()->with(["error_edit" => "email sudah digunakan"]);
        }

        // cek no hp apakah no hp baru sudah digunakan
        // get data no hp
        $getNoHp = DB::table("instrukturs")->where("no_hp_ins",'=',$no_hp)->where("id_ins",'!=',$id)->first();
        if($getNoHp == true){
            return back()->with(["error_edit" => "No hp sudah digunakan"]);
        }

        // edit data siswa
        $updateIns = DB::table("instrukturs")->where("id_ins",'=',$id)->update([
            "nama_ins" => $nama,
            "email_ins" => $email,
            "no_hp_ins" => $no_hp,
            "alamat_ins" => $alamat,
        ]);

        if($updateIns == true){
            // jika data email yang dimasukkan adlah email baru maka akan di edit, jika sama , brarti tidak di edit

            if($getEmailIns->email_ins != $email){
                // kondis  jika email yang dimasukkan berubah atau email baru
                $updateEmail = DB::table("users")->where("email",'=',$getEmailIns->email_ins)->update([
                    "email" => $email
                ]);

                if($updateEmail == true){
                    return back()->with(["sukses_edit" => "Berhasil mengubah data siswa"]);
                }
            }
            return back()->with(["sukses_edit" => "Berhasil mengubah data siswa"]);
        }else{
            return back()->with(["error_edit" => "Gagal mengubah data siswa"]);
        }
    }

}
