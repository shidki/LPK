<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\instruktur;
use App\Models\kelas;
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
        if (trim($nama) === '' || trim($email) === ''|| trim($nohp) === ''|| trim($alamat) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->nohp)) {
            return back()->with(['error_add' => 'Format nomor telepon tidak valid!']);
        }

        // cek kuota kelas
        $cekKelas = kelas::where("id_kelas",'=',$kelas)->first();
        $cekjmlsiswa = siswa::where("id_kelas",'=',$kelas)->count();
        // dd($cekjmlsiswa);
        if($cekjmlsiswa == $cekKelas->kuota){
            return back()->with(['error_add' => 'Kelas sudah penuh!']);

        }

        // dd($status);
        $ceknohp = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$nohp)->first();
        $ceknohpIns = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$nohp)->first();


        $cekEmail = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmailIns = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();
        $cekEmailadmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();
        $ceknohpadmin = admin::select("no_hp_adm")->from('admins')->where("no_hp_adm",'=',$nohp)->first();
        // cek email di table users ( udah ke register apa blom)
        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();
        
        // email tersedia
        if($cekEmail == true || $cekEmailIns == true || $cekEmail1 == true || $cekEmailadmin == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        if($ceknohp == true ||  $ceknohpIns == true ||  $ceknohpadmin == true ){
            return back()->with(["error_add" => "Nomor telepon tersedia!"]);
        }

        // ==== menentukan id siswa ====
        $cekCountSiswa = siswa::count();

        //dd($cekCountSiswa);
        $insertData = DB::table("siswas")->insert([
            "id_siswa" => "Siswa".$cekCountSiswa + 2,
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
            return back()->with(["sukses_add" => "Siswa berhasil ditambahkan!"]);

        }else{
            return back()->with(["sukses_add" => "Siswa gagal ditambahkan!"]);
        }
    }

    public function delete_siswa($id){
        $role = session("role");
        if($role != "admin"){
            return abort(403);

        }
        // dd($id);
        // getEmail yang dipake siswa sesuai id siswa
        $getEmail = DB::table("siswas")->select("email")->where('id_siswa','=', $id)->first();
        $deleteSiswa = DB::table('siswas')->where('id_siswa','=', $id)->delete();
        if($deleteSiswa == true){
            //  menghapus data siswa tpi emailnya udah kedaftar di table users 
            $getAkun = DB::table('users')->where('email','=', $getEmail->email)->first();
            // klo akun nya ktmu di table users brarti email yagn ada di table users juga dihapus
            if($getAkun == true){
                $deleteEmail = DB::table('users')->where('email','=', $getEmail->email)->delete();
                if($deleteEmail == true){
                    return back()->with(['sukses_delete' => "Siswa berhasil dihapus!"]);
                }else{
                    return back()->with(['error_delete' => "Akun siswa gagal dihapus!"]);
                }
            }else{
                // ini ketika delete siswa nya berhasil tpi email blm kedaftar
                return back()->with(['sukses_delete' => "Siswa berhasil dihapus!"]);
            }
            
        }else{
            return back()->with(['error_delete' => "Siswa gagal dihapus!"]);
        }
    }

    public function edit_siswa_admin(Request $request){
        $id = $request->siswas;
        $nama = $request->nama_siswaEdit;
        $email = $request->emailEdit;
        $tglLulus = $request->tglLulus;
        $no_hp = $request->nohpEdit;
        $alamat = $request->alamatEdit;
        $id_bidang = $request->bidang_siswaEdit;
        $id_kelas = $request->kelas_siswaEdit;
        $status = $request->status_siswaEdit;
        if (trim($nama) === '' || trim($email) === ''|| trim($no_hp) === ''|| trim($alamat) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->nohpEdit)) {
            return back()->with(['error_add' => 'Format nomor telepon tidak valid!']);
        }
        $cekKelasSiswa = siswa::where('id_siswa','=',$id)->first();
        if($id_kelas !== $cekKelasSiswa->id_kelas){
            $cekKelas = kelas::where("id_kelas",'=',$id_kelas)->first();
            $cekjmlsiswa = siswa::where("id_kelas",'=',$id_kelas)->count();
            // dd($cekjmlsiswa);
            if($cekjmlsiswa == $cekKelas->kuota){
                return back()->with(['error_add' => 'Kelas sudah penuh!']);
    
            }
        }
        // query dibawah adlah digunakan untuk menyimpan data email sebelumnya ( untuk update data akun ketika email yang dimasukkan adalah email baru)
        $getEmailSiswa = DB::table("siswas")->where("id_siswa",'=',$id)->first();
        // dd($getEmailSiswa);
        // cek email apakah email baru sudah digunakan
        // get data email
        $getEmail = DB::table("siswas")->where("email",'=',$email)->where("id_siswa",'!=',$id)->first();
        $getEmail1 = DB::table("users")->where("email",'=',$email)->where('id_akun','!=',$getEmailSiswa->id_akun)->first();
        $getEmail2 = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $cekEmailadmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();

        $ceknohpins = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$no_hp)->first();
        $ceknohpadmin = admin::select("no_hp_adm")->from('admins')->where("no_hp_adm",'=',$no_hp)->first();


        if($getEmail == true || $getEmail1 == true || $getEmail2 == true || $cekEmailadmin == true){
            return back()->with(["error_edit" => "Email sudah digunakan!"]);
        }
        
        // cek no hp apakah no hp baru sudah digunakan
        // get data no hp
        $getNoHp = DB::table("siswas")->where("no_hp",'=',$no_hp)->where("id_siswa",'!=',$id)->first();
        if($getNoHp == true || $ceknohpadmin == true || $ceknohpins == true){
            return back()->with(["error_edit" => "Nomor telepon sudah digunakan!"]);
        }

        // edit data siswa
        if($tglLulus == null){
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
                        return back()->with(["sukses_edit" => "Data siswa berhasil diubah!"]);
                    }
                }
                return back()->with(["sukses_edit" => "Data siswa berhasil diubah!"]);
            }else{
                return back()->with(["error_edit" => "Data siswa gagal diubah!"]);
            }
        }else{
            $updateSiswa = DB::table("siswas")->where("id_siswa",'=',$id)->update([
                "nama" => $nama,
                "email" => $email,
                "no_hp" => $no_hp,
                "alamat" => $alamat,
                "tgl_lulus" => $tglLulus,
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
                        return back()->with(["sukses_edit" => "Data siswa berhasil diubah!"]);
                    }
                }
                return back()->with(["sukses_edit" => "Data siswa berhasil diubah!"]);
            }else{
                return back()->with(["error_edit" => "Data siswa gagal diubah!"]);
            }            
        }
    }

    // ==================== INSTUKTUR ============================
    public function add_instruktur(Request $request){
        $nama = $request->nama;
        $email = $request->email;
        $nohp = $request->nohp;
        $alamat = $request->alamat;
        $tglMasuk = $request->tglMasuk;
        if (trim($nama) === '' || trim($email) === ''|| trim($nohp) === ''|| trim($alamat) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->nohp)) {
            return back()->with(['error_add' => 'Format nomor HP tidak valid.']);
        }
        // dd($status);
        $cekEmail = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $ceknohp = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$nohp)->first();
        $cekEmailAdmin = Admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();
        $ceknohpAdmin = Admin::select("no_hp_adm")->from('admins')->where("no_hp_adm",'=',$nohp)->first();
        $cekEmailSiswa = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $ceknohpSiswa = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$nohp)->first();

        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        
        // dd($cekEmail);
        // email tersedia
        if($cekEmail == true || $cekEmailSiswa == true || $cekEmail1 == true || $cekEmailAdmin == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        if($ceknohp == true ||  $ceknohpSiswa == true ||  $ceknohpAdmin == true ){
            return back()->with(["error_add" => "Nomor telepon sudah tersedia!"]);
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
            return back()->with(["sukses_add" => "Instruktur berhasil ditambahkan!"]);

        }else{
            return back()->with(["sukses_add" => "Instruktur gagal ditambahkan!"]);
        }
    }

    public function delete_instruktur($id){
        $role = session("role");
        if($role != "admin"){
            return abort(403);

        }
        // dd($id);
        // getEmail yang dipake instruktur sesuai id instruktur
        $getEmail = DB::table("instrukturs")->select("email_ins")->where('id_ins','=', $id)->first();
        $deleteSiswa = DB::table('instrukturs')->where('id_ins','=', $id)->delete();
        if($deleteSiswa == true){
            //  menghapus data siswa tpi emailnya dah kedaftar di table users
            $getAkun = DB::table('users')->where('email','=', $getEmail->email_ins)->first();
            // klo akun nya ktmu di table users brarti email yagn ada di table users juga dihapus
            if($getAkun == true){
                $deleteEmail = DB::table('users')->where('email','=', $getEmail->email_ins)->delete();
                if($deleteEmail == true){
                    return back()->with(['sukses_delete' => "Instruktur berhasil dihapus!"]);
                }else{
                    return back()->with(['error_delete' => "Akun instruktur gagal dihapus!"]);
                }
            }else{
                // ini ketika delete instruktur nya berhasil tpi email blm kedaftar
                return back()->with(['sukses_delete' => "Instruktur berhasil dihapus!"]);
            }
            
        }else{
            return back()->with(['error_delete' => "Instruktur gagal dihapus!"]);
        }
    }
    public function edit_instruktur(Request $request){
        $id = $request->instrukturs;
        $nama = $request->namaEdit;
        $email = $request->emailEdit;
        $no_hp = $request->nohpEdit;
        $alamat = $request->alamatEdit;
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->nohpEdit)) {
            return back()->with(['error_add' => 'Format nomor telepon tidak valid!']);
        }
        if (trim($nama) === '' || trim($email) === ''|| trim($no_hp) === ''|| trim($alamat) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }

        // query dibawah adlah digunakan untuk menyimpan data email sebelumnya ( untuk update data akun ketika email yang dimasukkan adalah email baru)
        $getEmailIns = DB::table("instrukturs")->where("id_ins",'=',$id)->first();

        // cek email apakah email baru sudah digunakan
        // get data email
        $getEmail = DB::table("instrukturs")->where("email_ins",'=',$email)->where("id_ins",'!=',$id)->first();
        $getEmail1 = DB::table("users")->where("email",'=',$email)->where("id_akun",'!=', $getEmailIns->id_akun)->first();
        $cekEmailSiswa = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $cekEmailadmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();

        if($getEmail == true || $getEmail1 == true || $cekEmailSiswa == true|| $cekEmailadmin == true){
            return back()->with(["error_edit" => "Email sudah digunakan!"]);
        }

        // cek no hp apakah no hp baru sudah digunakan
        // get data no hp
        $getNoHp = DB::table("instrukturs")->where("no_hp_ins",'=',$no_hp)->where("id_ins",'!=',$id)->first();
        $ceknohpadmin = admin::select("no_hp_adm")->from('admins')->where("no_hp_adm",'=',$no_hp)->first();
        $ceknohp = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$no_hp)->first();
        if($getNoHp == true || $ceknohpadmin == true || $ceknohp == true){
            return back()->with(["error_edit" => "Nomor telepon sudah digunakan!"]);
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
                    return back()->with(["sukses_edit" => "Data instruktur berhasil diubah!"]);
                }
            }
            return back()->with(["sukses_edit" => "Data instruktur berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Data instruktur gagal diubah!"]);
        }
    }


    //  ====================== ADMIN ========================
    public function add_admin(Request $request){
        // $request->validate([
        //     'nohp' => 'required|regex:/^\+?[0-9\s]{8,}$/',
        // ]);
        
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->nohp)) {
            return back()->with(['error_add' => 'Format nomor telepon tidak valid!']);
        }        
        $nama = $request->nama;
        $email = $request->email;
        $nohp = $request->nohp;
        $alamat = $request->alamat;
        $tglMasuk = $request->tglMasuk;
        if (trim($nama) === '' || trim($email) === ''|| trim($nohp) === ''|| trim($alamat) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        // dd($status);
        $cekEmail = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $ceknohp = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$nohp)->first();
        $cekEmailSiswa = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $ceknohpSiswa = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$nohp)->first();
        $cekEmailadmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->first();
        $ceknohpadmin = admin::select("no_hp_adm")->from('admins')->where("no_hp_adm",'=',$nohp)->first();

        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->first();

        
        // dd($cekEmail);
        // email tersedia
        if($cekEmail == true || $cekEmailSiswa == true || $cekEmail1 == true || $cekEmailadmin == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        if($ceknohp == true ||  $ceknohpSiswa == true ||  $ceknohpadmin == true ){
            return back()->with(["error_add" => "Nomor telepon sudah tersedia!"]);
        }

        $insertData = DB::table("admins")->insert([
            "nama_adm" => $nama,
            "email_adm" => $email,
            "no_hp_adm" => $nohp,
            "alamat_adm" => $alamat,
            "tgl_masuk_adm" => $tglMasuk,
        ]);
        if($insertData == true){
            return back()->with(["sukses_add" => "Admin berhasil ditambahkan!"]);

        }else{
            return back()->with(["sukses_add" => "Admin gagal ditambahkan!"]);
        }
    }
    public function edit_admin(Request $request){
        $admins = $request->admins;
        $nama = $request->namaEdit;
        $email = $request->emailEdit;
        $nohp = $request->nohpEdit;
        $alamat = $request->alamatEdit;
        if (!preg_match('/^\+?[0-9\s]{8,}$/', $request->nohpEdit)) {
            return back()->with(['error_add' => 'Format nomor HP tidak valid.']);
        } 
        if (trim($nama) === '' || trim($email) === ''|| trim($nohp) === ''|| trim($alamat) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }
        $getEmailAdmin = DB::table("admins")->where("id_adm",'=',$admins)->first();

        $cekEmail1 = users::select("email")->from('users')->where("email",'=',$email)->where("id_akun",'=',$getEmailAdmin->id_akun)->first();
        $cekEmail = instruktur::select("email_ins")->from('instrukturs')->where("email_ins",'=',$email)->first();
        $ceknohp = instruktur::select("no_hp_ins")->from('instrukturs')->where("no_hp_ins",'=',$nohp)->first();
        $cekEmailSiswa = siswa::select("email")->from('siswas')->where("email",'=',$email)->first();
        $ceknohpSiswa = siswa::select("no_hp")->from('siswas')->where("no_hp",'=',$nohp)->first();
        $cekEmailadmin = admin::select("email_adm")->from('admins')->where("email_adm",'=',$email)->where("id_adm",'!=',$admins)->first();
        $ceknohpadmin = admin::select("no_hp_adm")->from('admins')->where("no_hp_adm",'=',$nohp)->where("id_adm",'!=',$admins)->first();



        
        // query dibawah adlah digunakan untuk menyimpan data email sebelumnya ( untuk update data akun ketika email yang dimasukkan adalah email baru)
        
        // dd($cekEmail);
        // email tersedia
        if($cekEmail == true || $cekEmailSiswa == true || $cekEmail1 == true || $cekEmailadmin == true){
            return back()->with(["error_add" => "Email sudah tersedia!"]);
        }
        if($ceknohp == true ||  $ceknohpSiswa == true ||  $ceknohpadmin == true ){
            return back()->with(["error_add" => "Nomor telepon sudah tersedia!"]);
        }

        $updateAdm = DB::table("admins")->where("id_adm",'=',$admins)
        ->update([
            "nama_adm" => $nama,
            "email_adm" => $email,
            "no_hp_adm" => $nohp,
            "alamat_adm" => $alamat,
        ]);
        if($updateAdm == true){
            // jika data email yang dimasukkan adlah email baru maka akan di edit, jika sama , brarti tidak di edit

            if($getEmailAdmin->email_adm != $email){
                // kondis  jika email yang dimasukkan berubah atau email baru
                $updateEmail = DB::table("users")->where("email",'=',$getEmailAdmin->email_adm)->update([
                    "email" => $email
                ]);

                if($updateEmail == true){
                    return back()->with(["sukses_edit" => "Data admin berhasil diubah!"]);
                }
            }
            return back()->with(["sukses_edit" => "Data admin berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Data admin gagal diubah!"]);
        }
    }
    public function delete_admin($id){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        

        // getEmail yang dipake admin sesuai id admin
        $getEmail = DB::table("admins")->select("email_adm")->where('id_adm','=', $id)->first();
        // fitur gabisa ngehapus profile sendiri
        if($getEmail->email_adm == session("email")){
            return back()->with(['error_delete' => "Tidak bisa menghapus profil pribadi!"]);
        }


        $deleteAdmin = DB::table('admins')->where('id_adm','=', $id)->delete();
        if($deleteAdmin == true){
            //  menghapus data admin tpi emailnya sudah kedaftar di table users
            $getAkun = DB::table('users')->where('email','=', $getEmail->email_adm)->first();
            // klo akun nya ktmu di table users brarti email yagn ada di table users juga dihapus
            if($getAkun == true){
                $deleteEmail = DB::table('users')->where('email','=', $getEmail->email_adm)->delete();
                if($deleteEmail == true){
                    return back()->with(['sukses_delete' => "Admin berhasil dihapus!"]);
                }else{
                    return back()->with(['error_delete' => "Akun admin gagal dihapus!"]);
                }
            }else{
                // ini ketika delete admin nya berhasil tpi email blm kedaftar
                return back()->with(['sukses_delete' => "Admin berhasil dihapus!"]);
            }
            
        }else{
            return back()->with(['error_delete' => "Admin gagal dihapus!"]);
        }
    }

}
