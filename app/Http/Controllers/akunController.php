<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\instruktur;
use App\Models\nilai;
use App\Models\nilai_kuis;
use App\Models\siswa;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class akunController extends Controller
{
    // ============================== INSTRUKTUR ============================================
    public function add_akun_instruktur(Request $request){
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        $konfirmasiPw = str_replace(' ', '', $konfirmasiPw);
        
        if(session('role') != "admin"){
            return abort(403);
            
        }
        $email2 = trim($request->email);
        $email2 = str_replace(' ', '', $email);
        
        $password2 = bcrypt(trim($request->password));
        $password2 = str_replace(' ', '', $password);
        
        $konfirmasiPw2 = trim($request->konfirmasiPw);
        if (strpos($email2, ' ') !== false || strpos($password2, ' ') !== false || strpos($konfirmasiPw2, ' ') !== false) {
            // Jika ada spasi pada email, password, atau konfirmasi password
            return back()->with(["error_add" => "Input tidak boleh menggunakan spasi!"]);
        }
        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai!"]);
        }

        // cek apakah email sudah digunakan atau belum
        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmailadmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        if($cekEmail == true  || $cekEmail1 == true || $cekEmailadmin == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        //  cek apakah email yang didaftar udah kedaftar di table instruktur atau belum
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        if($cekEmailIns == false){
            // email ga dipake oleh instuktur manapun
            return back()->with(["error_add" => "Email tidak terdaftar pada instruktur!"]);
        }


        $addAkun = DB::table("users")->insert([
            "email" => $email,
            "password" => $password,
            "role" => "instruktur",
        ]);
        

        if($addAkun == true){
            // get id yang barusan ditambah
            $getId = DB::table("users")->where("email",'=',$email)->first();
            // update id akun pada instruktur yang emailnya didaftarin
            $updateIdAkun = DB::table("instrukturs")->where("email_ins",'=',$email)->update([
                "id_akun" => $getId->id_akun
            ]);
            if($updateIdAkun == true){
                return back()->with(["sukses_add" => "Akun instruktur berhasil ditambahkan!"]); 
            }else{
                return back()->with(["Akun instruktur gagal ditambahkan!"]);
            }
        }
    }
    public function edit_akun_instruktur(Request $request){
        $akuns = $request->akuns;
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        // $role = $request->role;

        if(session('role') != "admin"){
            return abort(403);

        }
        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai!"]);
        }
        $email2 = trim($request->email);
        $email2 = str_replace(' ', '', $email);
        
        $password2 = bcrypt(trim($request->password));
        $password2 = str_replace(' ', '', $password);
        
        $konfirmasiPw2 = trim($request->konfirmasiPw);
        if (strpos($email2, ' ') !== false || strpos($password2, ' ') !== false || strpos($konfirmasiPw2, ' ') !== false) {
            // Jika ada spasi pada email, password, atau konfirmasi password
            return back()->with(["error_add" => "Input tidak boleh menggunakan spasi!"]);
        }
        // cek apakah email sudah digunakan atau belum
        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->where('id_akun', '!=', $akuns)->first();
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')
        ->where("email_ins",'=',$email)
        ->where("id_akun",'!=',$akuns)
        ->first();

        if($cekEmail == true  || $cekEmail1 == true || $cekEmailIns == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }


        $edit_akun = DB::table("users")
        ->where("id_akun" ,'=',$akuns)
        ->update([
            "email" => $email,
            "password" => $password,
        ]);
        

        if($edit_akun == true){
            return back()->with(["sukses_edit" => "Akun instruktur berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Akun instruktur gagal diubah!"]);
        }
    }
    
    
    public function delete_akun_instruktur($id){
        $role = session("role");
        if($role != "admin"){
            return abort(403);

        }
        
        // mencari instruktur yang menggunakan email tersebut
        $getIns = instruktur::select("*")->where("id_akun",'=',$id)->first();
        // mengupdate id akun pada Ins tersebut
        // dd($getIns);
        $updateAkun = DB::table("instrukturs")->where("id_ins",'=',$getIns->id_ins)->update([
            "id_akun" => null
        ]);

        
        if($updateAkun == true){
            $deleteAkun = DB::table("users")->where("id_akun",'=',$id)->delete();
            
            if($deleteAkun){
                return back()->with(["sukses_delete" => "Akun instruktur berhasil dihapus!"]);
            }else{
                return back()->with(["error_delete" => "Akun instruktur gagal dihapus!"]);
            }
        }else{
            return back()->with(["error_delete" => "Akun instruktur gagal dihapus!"]);
        }
    }
    public function edit_status_akun_instruktur(Request $request){
        $id = $request->akuns;
        $status = $request->status;

        
        
        // get id akun berdasar email 
        $updateStatus = DB::table("users")->where("id_akun",'=',$id)->update([
            "status_akun" => $status
        ]);
        if($updateStatus == true){
            return back()->with(["sukses_edit" => "Status instruktur berhasil diubah!"]);
        }else{
            return back()->with(["error_delete" => "Status instruktur gagal diubah!"]);
        }
    }

    // ============================== ADMIN ============================================
    public function add_akun_admin(Request $request){
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        // $role = $request->role;

        if(session('role') != "admin"){
            return abort(403);

        }
        $email2 = trim($request->email);
        $email2 = str_replace(' ', '', $email);
        
        $password2 = bcrypt(trim($request->password));
        $password2 = str_replace(' ', '', $password);
        
        $konfirmasiPw2 = trim($request->konfirmasiPw);
        if (strpos($email2, ' ') !== false || strpos($password2, ' ') !== false || strpos($konfirmasiPw2, ' ') !== false) {
            // Jika ada spasi pada email, password, atau konfirmasi password
            return back()->with(["error_add" => "Input tidak boleh menggunakan spasi!"]);
        }
        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai!"]);
        }

        // cek apakah email sudah digunakan atau belum
        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        if($cekEmail == true  || $cekEmail1 == true || $cekEmailIns == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        //  cek apakah email yang didaftar udah kedaftar di table admin atau belum
        $cekEmailAdmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();
        if($cekEmailAdmin == false){
            // email ga dipake oleh instuktur manapun
            return back()->with(["error_add" => "Email tidak terdaftar pada Admin!"]);
        }


        $addAkun = DB::table("users")->insert([
            "email" => $email,
            "password" => $password,
            "role" => "admin",
        ]);
        

        if($addAkun == true){
            // get id yang barusan ditambah
            $getId = DB::table("users")->where("email",'=',$email)->first();
            // update id akun pada instruktur yang emailnya didaftarin
            $updateIdAkun = DB::table("admins")->where("email_adm",'=',$email)->update([
                "id_akun" => $getId->id_akun
            ]);
            if($updateIdAkun == true){
                return back()->with(["sukses_add" => "Akun admin berhasil ditambahkan!"]); 
            }else{
                return back()->with(["Akun admin gagal ditambahkan!"]);
            }
        }
    }
    public function delete_akun_admin($id){
        $role = session("role");
        if($role != "admin"){
            return abort(403);

        }
        
        // mencari admin yang menggunakan email tersebut
        $getIns = admin::select("*")->where("id_akun",'=',$id)->first();
        // mengupdate id akun pada Ins tersebut
        // dd($getIns);
        $updateAkun = DB::table("admins")->where("id_adm",'=',$getIns->id_adm)->update([
            "id_akun" => null
        ]);

        
        if($updateAkun == true){
            $deleteAkun = DB::table("users")->where("id_akun",'=',$id)->delete();
            
            if($deleteAkun){
                return back()->with(["sukses_delete" => "Akun admin berhasil dihapus!"]);
            }else{
                return back()->with(["error_delete" => "Akun admin gagal dihapus!"]);
            }
        }else{
            return back()->with(["error_delete" => "Akun admin gagal dihapus!"]);
        }
    }
    public function edit_akun_admin(Request $request){
        $akuns = $request->akuns;
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        // $role = $request->role;

        if(session('role') != "admin"){
            return abort(403);
        }
        $email2 = trim($request->email);
        $email2 = str_replace(' ', '', $email);
        
        $password2 = bcrypt(trim($request->password));
        $password2 = str_replace(' ', '', $password);
        
        $konfirmasiPw2 = trim($request->konfirmasiPw);
        if (strpos($email2, ' ') !== false || strpos($password2, ' ') !== false || strpos($konfirmasiPw2, ' ') !== false) {
            // Jika ada spasi pada email, password, atau konfirmasi password
            return back()->with(["error_add" => "Input tidak boleh menggunakan spasi!"]);
        }

        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai!"]);
        }

        // cek apakah email sudah digunakan atau belum
        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->where('id_akun', '!=', $akuns)->first();
        $cekEmailIns = admin::select("email_adm")->from('admins')
        ->where("email_adm",'=',$email)
        ->where("id_akun",'!=',$akuns)
        ->first();

        if($cekEmail == true  || $cekEmail1 == true || $cekEmailIns == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }


        $edit_akun = DB::table("users")
        ->where("id_akun" ,'=',$akuns)
        ->update([
            "email" => $email,
            "password" => $password,
        ]);
        


        if($edit_akun == true){
            // jika yang diubah tuh password akun pribadi
            if($email == session("email")){
                return redirect('/logout')->with(["sukses_edit" => "Silahkan Login Kembali"]);
            }
            return back()->with(["sukses_edit" => "Akun admin berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Akun admin gagal diubah!"]);
        }
    }

    public function edit_status_akun_admin(Request $request){
        $id = $request->akuns;
        $status = $request->status;


        // gagal update ketika yang diupdate adalah status akun pribadi
        // get email sesuai id akun
        $getId = users::where("id_akun",'=',$id)->first();
        if($getId->email == session("email")){
            return back()->with(["error_delete" => "Status akun pribadi tidak bisa diubah!"]);
        }
        // mengubah status akun
        $updateStatus = DB::table("users")->where("id_akun",'=',$id)->update([
            "status_akun" => $status
        ]);
        if($updateStatus == true){
            return back()->with(["sukses_edit" => "Status akun admin berhasil diubah!"]);
        }else{
            return back()->with(["error_delete" => "Status akun admin gagal diubah!"]);
        }
    }
    // ============================== SISWA ============================================
    public function add_akun_siswa(Request $request){
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        // $role = $request->role;

        if(session('role') != "admin"){
            return abort(403);

        }
        $email2 = trim($request->email);
        $email2 = str_replace(' ', '', $email);
        
        $password2 = bcrypt(trim($request->password));
        $password2 = str_replace(' ', '', $password);
        
        $konfirmasiPw2 = trim($request->konfirmasiPw);
        if (strpos($email2, ' ') !== false || strpos($password2, ' ') !== false || strpos($konfirmasiPw2, ' ') !== false) {
            // Jika ada spasi pada email, password, atau konfirmasi password
            return back()->with(["error_add" => "Input tidak boleh menggunakan spasi!"]);
        }
        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai!"]);
        }

        // cek apakah email sudah digunakan atau belum
        
        $cekEmailAdmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        if($cekEmailAdmin == true  || $cekEmail1 == true || $cekEmailIns == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        //  cek apakah email yang didaftar udah kedaftar di table admin atau belum
        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        if($cekEmail == false){
            // email ga dipake oleh instuktur manapun
            return back()->with(["error_add" => "Email tidak terdaftar pada Siswa!"]);
        }


        $addAkun = DB::table("users")->insert([
            "email" => $email,
            "password" => $password,
            "role" => "siswa",
        ]);
        

        if($addAkun == true){
            // get id yang barusan ditambah
            $getId = DB::table("users")->where("email",'=',$email)->first();
            // update id akun pada instruktur yang emailnya didaftarin
            $updateIdAkun = DB::table("siswas")->where("email",'=',$email)->update([
                "id_akun" => $getId->id_akun
            ]);
            if($updateIdAkun == true){
                return back()->with(["sukses_add" => "Akun siswa berhasil ditambahkan!"]); 
            }else{
                return back()->with(["Akun siswa gagal ditambahkan!"]);
            }
        }
    }
    public function delete_akun_siswa($id){
        $role = session("role");
        if($role != "admin"){
            return abort(403);

        }
        
        // cek kalau siswa dia udah pnya data nilai brarti gabisa dihapus
        $cekNilai = nilai_kuis::where("id_siswa",'=',$id)->first();
        $cekNilai = nilai::where("id_siswa",'=',$id)->first();
        if($cekNilai == true){
            return back()->with(["error_delete" => "Siswa memiliki data nilai!"]);

        }

        // mencari admin yang menggunakan email tersebut
        $getIns = siswa::select("*")->where("id_akun",'=',$id)->first();
        // mengupdate id akun pada Ins tersebut
        // dd($getIns);
        $updateAkun = DB::table("siswas")->where("id_siswa",'=',$getIns->id_siswa)->update([
            "id_akun" => null
        ]);

        
        if($updateAkun == true){
            $deleteAkun = DB::table("users")->where("id_akun",'=',$id)->delete();
            
            if($deleteAkun){
                return back()->with(["sukses_delete" => "Akun siswa berhasil dihapus!"]);
            }else{
                return back()->with(["error_delete" => "Akun siswa gagal dihapus!"]);
            }
        }else{
            return back()->with(["error_delete" => "Akun siswa gagal dihapus!"]);
        }
    }
    public function edit_akun_siswa(Request $request){
        $akuns = $request->akuns;
        $email = $request->email;
        $password = bcrypt($request->password);
        $konfirmasiPw = $request->konfirmasiPw;
        // $role = $request->role;

        if(session('role') != "admin"){
            return abort(403);

        }
        if($konfirmasiPw != $request->password){
            return back()->with(["error_add" => "Password tidak sesuai!"]);
        }
        $email2 = trim($request->email);
        $email2 = str_replace(' ', '', $email);
        
        $password2 = bcrypt(trim($request->password));
        $password2 = str_replace(' ', '', $password);
        
        $konfirmasiPw2 = trim($request->konfirmasiPw);
        if (strpos($email2, ' ') !== false || strpos($password2, ' ') !== false || strpos($konfirmasiPw2, ' ') !== false) {
            // Jika ada spasi pada email, password, atau konfirmasi password
            return back()->with(["error_add" => "Input tidak boleh menggunakan spasi!"]);
        }
        $edit_akun = DB::table("users")
        ->where("id_akun" ,'=',$akuns)
        ->update([
            "email" => $email,
            "password" => $password,
        ]);
        
        if($edit_akun == true){
            return back()->with(["sukses_edit" => "Akun siswa berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Akun siswa gagal diubah!"]);
        }
    }
    public function edit_status_akun_siswa(Request $request){
        $id = $request->akuns;
        $status = $request->status;
        // cek status siswa aktif apa engga
        $getEmail = users::where("id_akun",'=',$id)->first();
        $getStatusSiswa = siswa::where("email",'=',$getEmail->email)->first();
        if($getStatusSiswa->status != "aktif"){
            return back()->with(["error_edit" => "Siswa bukan merupakan siswa aktif!"]);
        }
        // mengubah status akun
        $updateStatus = DB::table("users")->where("id_akun",'=',$id)->update([
            "status_akun" => $status
        ]);
        if($updateStatus == true){
            return back()->with(["sukses_edit" => "Status akun siswa berhasil diubah!"]);
        }else{
            return back()->with(["error_delete" => "Status akun siswa gagal diubah!"]);
        }
    }
}
