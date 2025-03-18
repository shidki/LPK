<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\users;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function loginCounter(){
        if(session('email') != null){
            return redirect()->route('dashboard');
        }else{
            return view('auth.login.login');
        }
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $getname = users::select("*")
            ->from("users")
            ->where("email",'=',$request->email)
            ->first();
            // dd($getname);
            if($getname->status_akun == "tidak_aktif"){
                return back()->with(["error_login" => "Status akun tidak aktif!"]);
            }
            // cek apakah yang login siswa atau bukan
            $siswa = siswa::where("email",'=',$request->email)->first();
            if($siswa == true){
                if($siswa->status == "lulus"){
                    return back()->with(["error_login2" => "Status siswa $siswa->nama telah lulus!"]);
                }
            }
            session(['email' => $request->email]);
            session(['role' => $getname->role]);
            return redirect()->route('dashboard');
        }else{
            // dd($request->email);
            $cek_email = users::select("*")
            ->from("users")
            ->where("email",'=',$request->email)
            ->first();
            //dd($cek_email);
            if($cek_email == false){
                return back()->with([
                    'login_error' => 'Email tidak tersedia!',
                ])->onlyInput('email'); 
            }else{
                return back()->with([
                    'login_error' => 'Password Salah!',
                ])->onlyInput('email');
            }
        }
    }
    public function register(Request $request){
        $email = $request->emailReg;
        $password = bcrypt($request->passwordReg);
        // dd($request->confirmPasswordReg);
        $cekemail = users::select("email")
        ->from("users")
        ->where("email",'=',$email)
        ->first();

        if($cekemail){
            //  artinya email sudah ada di database maka akan menghasilkan error saat mendaftar akan
            return back()->with(["signup_error" => "Email sudah digunakan!"]);
        }

        $getStatusSiswa = siswa::where("email",'=',$email)->first();
        if($getStatusSiswa == true){
            if($getStatusSiswa->status != "aktif"){
                return back()->with(["signup_error" => "Siswa bukan merupakan siswa aktif!"]);
            }
        }
        // cek apakah email nya udah terdaftar di tabel siswa apa belum
        $cekemail1 = siswa::select("email")
        ->from("siswas")
        ->where("email",'=',$email)
        ->first();
        // dd($cekemail1);
        if($cekemail1 == false){
            //  artinya email belum ada di tabel siswa, artinya email tidak digunakan oleh siswa manapun yang terdaftar
            return back()->with(["signup_error" => "Email siswa belum terdaftar!"]);
        }

        if($request->passwordReg == $request->confirmPasswordReg){
            $insertData = users::insert([
                "email" => $email,
                "password" => $password,
                "role" => "siswa",
            ]);
            if($insertData){
                // get id akun yang udah didaftar barusan
                $getSiswa = DB::table("siswas")->select("*")->where("email",'=',$email)->first();

                $getId = DB::table("users")->select("*")->where("email",'=',$email)->first();
                // update data id akun di siswa 
                $updateSiswa = DB::table("siswas")->where("id_siswa",'=',$getSiswa->id_siswa)->update([
                    "id_akun" => $getId->id_akun
                ]);
                // dd($updateSiswa);
                if($updateSiswa == true){
                    return redirect()->intended('/')->with(["message" => "Akun telah berhasil dibuat, hubungi admin untuk melakukan aktifasi akun!"]);
                }else{
                    return back()->with([
                        'signup_error' => 'Pendaftaran gagal dilakukan!',
                    ]);
                }
            }else{
                return back()->with([
                    'signup_error' => 'Pendaftaran gagal dilakukan!',
                ]);
            }
        }else{
            return back()->with(['signup_error' => "Password tidak sesuai!"]);
        }
        
    }
    public function logout() {
        $successMessage = session('sukses_edit');
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        session()->forget('email');
        session()->forget('nama');
        session()->forget('role');
        
        return redirect("/")->with(['sukses_edit' => $successMessage, 'message' => "Berhasil keluar akun!"]);
    }
    

    public function HalamanResetSandi(){
        return view("auth.reset_password.resetPassword");
    }
    public function resetPassword(Request $request)
    {
        $email = $request->input('email');
        // Validasi jika diperlukan
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Buat kode verifikasi
        $verificationCode = rand(100000, 999999);

        // menambah kode token ke database

        $addToken =  DB::table('users')->where('email','=',$email)
        ->update([
            'kode_reset' => $verificationCode,
        ]);

        if($addToken){
            Mail::to($email)->send(new \App\Mail\ResetPasswordMail($verificationCode));
        }
        return response()->json(['success' => true, 'message' => 'Kode verifikasi telah dikirim ke email Anda!']);
    }


    public function resetPassword2(Request $request){
        $email = $request->input('email');
        $kode = $request->input('kode');

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // cek kode sesuai email
        $cekkode = users::select("kode_reset")->where("email",'=',$email)->first();
        if (!$cekkode) {
            return response()->json(['success' => false, 'message' => 'Email tidak ditemukan!']);
        }
        
        if ($kode == $cekkode->kode_reset) {
            return response()->json(['success' => true, 'message' => 'Kode verifikasi sesuai!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Kode verifikasi tidak sesuai!']);
        }
        
    }

    public function confirmResetPassword(Request $request){
        $email = $request->email;
        $kode = $request->kode;
        $password = bcrypt($request->passwordVerif);


        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $cekkode = users::select("kode_reset")->where("email",'=',$email)->first();
        if (!$cekkode) {
            return back()->with(["error_reset" => "Kode tidak sesuai!"]);
        }

        if ($kode == $cekkode->kode_reset) {

            $updatePassword = DB::table("users")->where('email','=',$email)->update([
                "password" => $password
            ]);

            if($updatePassword == true){
                $updatePassword = DB::table("users")->where('email','=',$email)->update([
                    "kode_reset" => null
                ]);
                return redirect('/')->with(["success_reset" => "Password berhasil diubah!"]);
            }else{
                $updatePassword = DB::table("users")->where('email','=',$email)->update([
                    "kode_reset" => null
                ]);
                return back()->with(["error_reset" => "Password gagal diubah!"]);
            }
        } else {
            $updatePassword = DB::table("users")->where('email','=',$email)->update([
                "kode_reset" => null
            ]);
            return back()->with(["error_reset" => "Kode tidak sesuai!"]);
        }
    }

    public function edit_profile(Request $request){

        $email = $request->email;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->no_hp)) {
            return back()->with(['error_edit' => 'Format nomor telepon tidak valid!']);
        } 
        // cek apakah no hp yang dimasukkan udah ada di database atau belum ( kondisi no hp nya udah dipake siswa lain blom)

        $cekNoHp = DB::table('siswas')->where('no_hp', $no_hp)->where('email','!=', $email)
        ->union(DB::table('instrukturs')->where('no_hp_ins', $no_hp))
        ->union(DB::table('admins')->where('no_hp_adm', $no_hp))
        ->exists();


        if($cekNoHp == true){
            return back()->with(["error_edit" => "No telepon sudah tersedia!"]);
        }

        $updateProfile = DB::table("siswas")->where("email",'=',$email)->update([
            "no_hp" => $no_hp,
            "alamat" => $alamat,
        ]);
        if($updateProfile == true){
            return back()->with(["sukses_edit" => "Profil berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Profil gagal diubah!"]);
        }
    }
    public function edit_profile_ins(Request $request){

        $email = $request->email;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->no_hp)) {
            return back()->with(['error_edit' => 'Format nomor telepon tidak valid!']);
        } 
        // cek apakah no hp yang dimasukkan udah ada di database atau belum ( kondisi no hp nya udah dipake apa blom)

        $cekNoHp = DB::table('instrukturs')->where('no_hp_ins', $no_hp)->where('email_ins','!=', $email)
        ->union(DB::table('siswas')->where('no_hp', $no_hp))
        ->union(DB::table('admins')->where('no_hp_adm', $no_hp))
        ->exists();


        if($cekNoHp == true){
            return back()->with(["error_edit" => "No telepon sudah tersedia!"]);
        }

        $updateProfile = DB::table("instrukturs")->where("email_ins",'=',$email)->update([
            "no_hp_ins" => $no_hp,
            "alamat_ins" => $alamat,
        ]);
        if($updateProfile == true){
            return back()->with(["sukses_edit" => "Profil berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Profil gagal diubah!"]);
        }
    }
    public function edit_profile_adm(Request $request){

        $email = $request->email;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        if (!preg_match('/^(\+?[0-9]{1,3}[0-9]{1,}|[0-9]{1,})$/', $request->no_hp)) {
            return back()->with(['error_edit' => 'Format nomor telepon tidak valid!']);
        } 
        // cek apakah no hp yang dimasukkan udah ada di database atau belum ( kondisi no hp nya udah dipake apa blom)

        $cekNoHp = DB::table('admins')->where('no_hp_adm', $no_hp)->where('email_adm','!=', $email)
        ->union(DB::table('siswas')->where('no_hp', $no_hp))
        ->union(DB::table('instrukturs')->where('no_hp_ins', $no_hp))
        ->exists();


        if($cekNoHp == true){
            return back()->with(["error_edit" => "No telepon sudah tersedia!"]);
        }

        $updateProfile = DB::table("admins")->where("email_adm",'=',$email)->update([
            "no_hp_adm" => $no_hp,
            "alamat_adm" => $alamat,
        ]);
        if($updateProfile == true){
            return back()->with(["sukses_edit" => "Profil berhasil diubah!"]);
        }else{
            return back()->with(["error_edit" => "Profil gagal diubah!"]);
        }
    }
}
