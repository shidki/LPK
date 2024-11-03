<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\bidang_minat;
use App\Models\instruktur;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class halamanController extends Controller
{
    // ================ DASHBOARD AWAL ( BUKAN DASHBOARD ADMIN) ==========================
    public function dashboard(){
        $role = session("role");
        // dd($role);
        if($role != "admin" && $role != "siswa" && $role != "guru"){
            return abort(403);
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

    // ==================== DASHBOARD ADMINISTRASI ==========================
    public function dashboardAdmin(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }

        return view('admin.dashboard_admin.dashboard_admin');
    }

    public function akunSiswa(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $akun = users::select("*")->where("role",'=',"siswa")->get();
        // dd($akun);
        return view('admin.kelola_akun.akun_siswa')->with(["akun" => $akun]);
    }
    public function akunInstruktur(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $akun = users::select("*")->where("role",'=',"instruktur")->get();
        // dd($akun);
        return view('admin.kelola_akun.akun_instruktur')->with(["akun" => $akun]);
    }
    public function akunAdmin(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $akun = users::select("*")->where("role",'=',"admin")->get();
        // dd($akun);
        return view('admin.kelola_akun.akun_admin')->with(["akun" => $akun]);
    }
    public function dataSiswa(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }

        $siswa = siswa::select("s.*",'b.nama_bidang','k.nama_kelas')
        ->from("siswas as s")
        ->join("bidang_minats as b",'b.id_bidang','=',"s.id_bidang")
        ->join("kelas as k",'k.id_kelas','=',"s.id_kelas")
        ->get();
        $kelas = kelas::select("*")->get();
        $bidang = bidang_minat::select("*")->get();
        return view('admin.kelola_profile.profile_siswa')->with(['siswa' => $siswa,'kelas' => $kelas,'bidang' => $bidang]);
    }

    public function dataInstruktur(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }

        $instruktur = instruktur::select("*")->get();
        return view('admin.kelola_profile.profile_instruktur')->with(['instruktur' => $instruktur]);
    }
    public function dataKelas(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }

        $kelas = kelas::select("k.*", 'i.nama_ins', 'i.id_ins', DB::raw('IFNULL(jumlah_siswa.jumlah, 0) as jumlah_siswa'))
        ->from("kelas as k")
        ->leftJoin("instrukturs as i", 'k.id_ins', '=', 'i.id_ins')
        ->leftJoinSub(
            DB::table('siswas')
                ->select('id_kelas', DB::raw('COUNT(*) as jumlah'))
                ->groupBy('id_kelas'),
            'jumlah_siswa',
            'jumlah_siswa.id_kelas',
            '=',
            'k.id_kelas'
        )
        ->distinct()
        ->get();
    
        // dd($kelas);
        $instruktur = instruktur::select("*")->get();
        return view('admin.kelola_kelas.kelas')->with(['kelas' => $kelas , 'instruktur' => $instruktur]);
    }
    public function dataAdmin(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }

        $admin = admin::select("*")->get();
        return view('admin.kelola_profile.profile_admin')->with(['admin' => $admin]);
    }
    public function dataBidang(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }

        $bidang = bidang_minat::select("*")->get();
        return view('admin.kelola_bidang.bidang')->with(['bidang' => $bidang]);
    }
    public function edit_profile($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return abort(403);
        }
        // counter agar siswa lain engga mencoba get url dengan id siswa lain
        $getEmail = siswa::select("email")->from("siswas")->where("id_siswa",'=',$id)->first();
        // dd($email);
        if($getEmail->email != $email){
            return abort(403);
        }

        // get data siswa
        $getData = DB::table("siswas")->select("*")->where("id_siswa",'=',$id)->first();
        return view("siswa.edit_profile.edit_profile")->with(["siswa" => $getData]);
    }
}
