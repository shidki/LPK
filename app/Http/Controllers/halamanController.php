<?php

namespace App\Http\Controllers;

use App\Models\instruktur;
use App\Models\siswa;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class halamanController extends Controller
{
    //
    public function dashboard(){
        $role = session("role");
        // dd($role);
        if($role != "admin" && $role != "siswa" && $role != "guru"){
            return redirect('/');
        }else{
            $email = session("email");
            if($role == "siswa"){
                // get data siswa
                $getsiswa = siswa::where("email",'=',$email)->first();
                return view('dashboard_menu.dashboard')->with(['siswa' => $getsiswa]);
            }elseif($role == "admin"){
                $email = session("email");
                return view('dashboard_menu.dashboard')->with(['admin' => $email]);
            }
        }
    }
    public function profile(){

    }

    public function dashboardAdmin(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }

        return view('admin.dashboard_admin.dashboard_admin');
    }

    public function akunInstruktur(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }
        $akun = users::select("*")->get();
        return view('admin.dashboard_admin.kelola_akun.akun_instruktur')->with(["akun" => $akun]);
    }
    public function dataSiswa(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }

        $siswa = siswa::select("*")->get();
        return view('admin.dashboard_admin.kelola_profile.profile_siswa')->with(['siswa' => $siswa]);
    }
    public function dataInstruktur(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }

        $instruktur = instruktur::select("*")->get();
        return view('admin.dashboard_admin.kelola_profile.profile_instruktur')->with(['instruktur' => $instruktur]);
    }
    public function edit_profile($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return redirect('/');
        }
        // counter agar siswa lain engga mencoba get url dengan id siswa lain
        $getEmail = siswa::select("email")->from("siswas")->where("id_siswa",'=',$id)->first();
        // dd($email);
        if($getEmail->email != $email){
            return back();
        }

        // get data siswa
        $getData = DB::table("siswas")->select("*")->where("id_siswa",'=',$id)->first();
        return view("siswa.edit_profile.edit_profile")->with(["siswa" => $getData]);
    }
}
