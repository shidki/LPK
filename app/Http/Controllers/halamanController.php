<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\admin;
use App\Models\bidang_minat;
use App\Models\daftar_hadir;
use App\Models\instruktur;
use App\Models\jadwal;
use App\Models\kelas;
use App\Models\kompNilai;
use App\Models\kuis;
use App\Models\mapel;
use App\Models\materi;
use App\Models\opsi_pg;
use App\Models\siswa;
use App\Models\soal;
use App\Models\users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class halamanController extends Controller
{
    // ================ DASHBOARD AWAL ( BUKAN DASHBOARD ADMIN) ==========================
    public function dashboard(){
        $role = session("role");
        // dd($role);
        if($role != "admin" && $role != "siswa" && $role != "instruktur"){
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
            }elseif($role == "instruktur"){
                $email = session("email");
                $getsiswa = instruktur::where("email_ins",'=',$email)->first();
                //dd($getsiswa);
                return view('dashboard_menu.dashboard')->with(['instruktur' => $getsiswa]);
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

        // get kelas untuk nampilin di side bar
        $listkelas = kelas::get();
        return view('admin.dashboard_admin.dashboard_admin')->with(["listkelas" => $listkelas]);
    }

    public function akunSiswa(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $akun = users::select("*")->where("role",'=',"siswa")->get();
        $listkelas = kelas::get();
        return view('admin.kelola_akun.akun_siswa')->with(["akun" => $akun , 'listkelas' => $listkelas]);
    }
    public function akunInstruktur(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $akun = users::select("*")->where("role",'=',"instruktur")->get();
        $listkelas = kelas::get();

        return view('admin.kelola_akun.akun_instruktur')->with(["akun" => $akun , "listkelas" => $listkelas]);
    }
    public function akunAdmin(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $akun = users::select("*")->where("role",'=',"admin")->get();
        $listkelas = kelas::get();

        return view('admin.kelola_akun.akun_admin')->with(["akun" => $akun , "listkelas" => $listkelas]);
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
        $kelas = kelas::select("*")->get(); // ini buat nampilin kelas di sidebar dan buat option  di add dan edit
        $bidang = bidang_minat::select("*")->get();
        
        return view('admin.kelola_profile.profile_siswa')->with(['siswa' => $siswa,'kelas' => $kelas,'bidang' => $bidang]);
    }

    public function dataInstruktur(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $listkelas = kelas::get();

        $instruktur = instruktur::select("*")->get();
        return view('admin.kelola_profile.profile_instruktur')->with(['instruktur' => $instruktur, 'listkelas' => $listkelas]);
    }
    public function dataKompNilai(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $listkelas = kelas::get();

        $kompNilai = kompNilai::select("*")->get();
        return view('admin.kelola_komp_nilai.kompNilai')->with(['kompNilai' => $kompNilai, 'listkelas' => $listkelas]);
    }
    public function dataKelas(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $listkelas = kelas::get();

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
        return view('admin.kelola_kelas.kelas')->with(['kelas' => $kelas , 'instruktur' => $instruktur, 'listkelas' => $listkelas]);
    }
    public function dataAdmin(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $listkelas = kelas::get();

        $admin = admin::select("*")->get();
        return view('admin.kelola_profile.profile_admin')->with(['admin' => $admin,'listkelas' => $listkelas]);
    }
    public function dataBidang(){
        $role = session("role");
        if($role != "admin"){
            return abort(403);
        }
        $listkelas = kelas::get();
        $bidang = bidang_minat::select("*")->get();
        return view('admin.kelola_bidang.bidang')->with(['bidang' => $bidang,'listkelas' => $listkelas]);
    }



    // =================== EDIT PROFILE SISWA ================
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
        $getData = DB::table("siswas as s")->select("s.*",'k.nama_kelas','b.nama_bidang')
        ->where("s.id_siswa",'=',$id)
        ->join("kelas as k",'k.id_kelas','=','s.id_kelas')
        ->join("bidang_minats as b",'b.id_bidang','=','s.id_bidang')
        ->first();
        return view("siswa.edit_profile.edit_profile")->with(["siswa" => $getData]);
    }


    public function materiPembelajaran(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }

        $getIns = instruktur::where("email_ins",'=',$email)->first();
        $mapel = mapel::get();
        $materi = materi::select("mapels.id_mapel as id_mapels", 'materis.*')
        ->from("materis")
        ->join("mapels",'mapels.id_mapel','=',"materis.id_mapel")
        ->get();
        return view("instruktur.materi.materi")->with(["instruktur" => $getIns, "mapel" => $mapel, "materi" => $materi]);
    }

    public function kuis(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        $getKuis = kuis::select("kuis.*",'mapels.nama_mapel')->from("kuis")->join("mapels",'mapels.id_mapel','=','kuis.id_mapel')->get();
        $getMapel = mapel::get();
        $getIns = instruktur::where("email_ins",'=',$email)->first();
        return view("instruktur.kuis.kuis")->with(["kuis" => $getKuis,'mapel' => $getMapel, "instruktur" => $getIns]);
    }

    public function view_soal($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        // Query untuk mengambil soal beserta kuis dan jawaban terkait
        $getSoal = Soal::select("soals.*", "kuis.judul_kuis", "jawabans.jawaban")
            ->join("kuis", "soals.id_kuis", "=", "kuis.id_kuis")
            ->join("jawabans", "soals.id_soal", "=", "jawabans.id_soal")
            ->where("kuis.id_kuis", '=', $id)
            ->get();

        // Ambil semua id_soal dari $getSoal
        $idSoalList = $getSoal->pluck('id_soal')->toArray();

        // Query untuk mengambil opsi yang terkait dengan id_soal dalam $idSoalList
        $getOpsi = opsi_pg::get();
        //$getOpsi = opsi_pg::whereIn("id_soal", $idSoalList)
        //    ->get()
        //    ->groupBy('id_soal'); // Mengelompokkan opsi berdasarkan id_soal

        //dd($getSoal);
        // Kirim data ke view
        return view("instruktur.kuis.soal")->with([
            "soal" => $getSoal,
            "opsi" => $getOpsi,
            "kuiss" => $id
        ]);
    }

    public function absensi(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }

        // get id isntruktur
        $getId = instruktur::where("email_ins",'=',$email)->first();
        //dd($getId);


        //cek status jadwal
        $getTglSelected = session('tanggal_selected'); // tanggal yang dikirim dari view berdasar tanggal
        if($getTglSelected != null){
            $getStatus = jadwal::select("j.*")
                ->from('jadwals as j')
                ->join("kelas as k",'k.id_kelas','=','j.id_kelas')
                ->where("k.id_ins",'=',$getId->id_ins)
                ->whereDate('j.tanggal_pelaksanaan', $getTglSelected)
                ->first();
            //dd(55);

        }else{
            $getStatus = jadwal::select("j.*")
            ->from('jadwals as j')
            ->join("kelas as k",'k.id_kelas','=','j.id_kelas')
            ->where("k.id_ins",'=',$getId->id_ins)
            ->whereDate('j.tanggal_pelaksanaan', Carbon::now()->toDateString())
            ->first();
            //dd($getStatus);
        }


        // ini buat tanggal di select yang atas
        Carbon::setLocale('id');
        $getTglJadwal = jadwal::select(
            'j.tanggal_pelaksanaan',
            'j.tanggal_pelaksanaan as tanggal' // Tambahkan kolom tanggal dengan nama alias
        )
        ->from('jadwals as j')
        ->join('kelas as k', 'k.id_kelas', '=', 'j.id_kelas')
        ->where('k.id_ins', '=', $getId->id_ins)
        ->get()
        ->map(function ($item) {
            $tanggal = Carbon::parse($item->tanggal_pelaksanaan);
            $item->tanggal = $tanggal->translatedFormat('l, d F Y'); // Format tanggal baru
            return $item;
        });

        // ini buat cek sesion listDaftarHadir yang dari function viewListAbsenBerdasarTanggal di absensiController
        //dd(session("listDaftarHadir"));
        if(session("listDaftarHadir") != null){
            //dd(session("listDaftarHadir"));
            return view("instruktur.absensi.absensi")->with(["siswa" => session("listDaftarHadir"), 'status' => $getStatus->status,'tglJadwal' => $getTglJadwal,'tanggal_selected_format' => session('tanggal_selected_format'), 'tanggal_selected' => session('tanggal_selected'),'id_jadwal' => $getStatus->id_jadwal]);
        }else{
            $siswa = siswa::select('s.*')
            ->from("siswas as s")
            ->join("kelas as k", "k.id_kelas", "=", "s.id_kelas")
            ->where("k.id_ins", "=", $getId->id_ins)
            ->get();
        
            // Ambil daftar hadir berdasarkan tanggal pelaksanaan
            $getDaftarHadir = daftar_hadir::select('d.id_siswa', 'd.status_presensi')
                ->from("daftar_hadirs as d")
                ->join("jadwals as j", 'd.id_jadwal', '=', 'j.id_jadwal')
                ->join("kelas as k", 'k.id_kelas', '=', 'j.id_kelas')
                ->where("k.id_ins", '=', $getId->id_ins)
                ->where("j.tanggal_pelaksanaan", '=', Carbon::now()->toDateString())
                ->get();
                //dd($getDaftarHadir);
    
            foreach ($siswa as $siswas) {
                $statusPresensi = $getDaftarHadir->where('id_siswa', $siswas->id_siswa)->first();
                $siswas->status_presensi = $statusPresensi ? $statusPresensi->status_presensi : 'Belum Absen';
            }
            return view("instruktur.absensi.absensi")->with(["siswa" => null,"siswa2" => $siswa, 'status' => $getStatus->status,'tglJadwal' => $getTglJadwal, 'tanggal_selected_format' => session('tanggal_selected_format'), 'tanggal_selected' => session('tanggal_selected'),'id_jadwal' => $getStatus->id_jadwal]);
        }
    }
}
