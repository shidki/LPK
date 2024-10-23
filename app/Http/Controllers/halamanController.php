<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class halamanController extends Controller
{
    //
    public function dashboard(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }

        $email = session("email");
        return view('dashboard_menu.dashboard')->with(['email' => $email]);
    }
    public function profile(){

    }

    public function dashboardAdmin(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }

        return view('dashboard_admin.dashboard_admin');
    }

    public function akunSiswa(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }
        return view('dashboard_admin.kelola_akun.akun_siswa');
    }
    public function dataSiswa(){
        $role = session("role");
        if($role != "admin"){
            return redirect('/');
        }

        $siswa = siswa::select("*")->get();
        return view('dashboard_admin.kelola_profile.profile_siswa')->with(['siswa' => $siswa]);
    }
}
