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
use App\Models\nilai;
use App\Models\nilai_kuis;
use App\Models\opsi_pg;
use App\Models\siswa;
use App\Models\soal;
use App\Models\users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class halamanController extends Controller
{
    // ================ DASHBOARD AWAL ( BUKAN DASHBOARD ADMIN) ==========================
    public function dashboard(){
        // =========================================
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
                $getAdmin = admin::where("email_adm",'=',$email)->first();
                return view('dashboard_menu.dashboard')->with(['admin' => $getAdmin]);
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

        $siswa = siswa::count();
        $siswaLulus = siswa::where("status",'=',"lulus")->count();
        $instruktur = instruktur::count();

        $cekBidang = DB::table('bidang_minats')->count();

        if ($cekBidang > 0) {
            $bidang = DB::table('bidang_minats as b')
                ->select(
                    'b.id_bidang', 
                    'b.nama_bidang', 
                    DB::raw('COUNT(s.id_siswa) as jumlah_siswa')
                )
                ->leftJoin('siswas as s', 's.id_bidang', '=', 'b.id_bidang')
                ->groupBy('b.id_bidang', 'b.nama_bidang')
                ->get();
        } else {
            $bidang = collect([]); // Kosongkan collection biar tetap bisa di-loop tanpa error
        }
        


        if($bidang) {
            foreach ($bidang as $item) {
                if ($item->jumlah_siswa > 0 && $siswa > 0) {
                    // Menghitung persentase siswa di bidang tersebut
                    $item->persentase_siswa = ($item->jumlah_siswa / $siswa) * 100;
                } else {
                    $item->persentase_siswa = 0;
                }
            }
        }

        if ($siswa > 0) {
            $persentaseLulus = ($siswaLulus / $siswa) * 100; // Persentase siswa lulus
        } else {
            $persentaseLulus = 0; // Menghindari pembagian dengan 0
        }
        
        // get kelas untuk nampilin di side bar
        $listkelas = kelas::get();
        return view('admin.dashboard_admin.dashboard_admin')->with(["listkelas" => $listkelas,"siswa" => $siswa,"instruktur" => $instruktur,"siswaLulus" => $persentaseLulus,"bidang" => $bidang,'jmllulus' => $siswaLulus]);
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
        $jmlBobot = 0;
        foreach($kompNilai as $item){
            $jmlBobot += $item->proporsi_nilai;
        }
        //dd($jmlBobot);
        return view('admin.kelola_komp_nilai.kompNilai')->with(['kompNilai' => $kompNilai, 'listkelas' => $listkelas, 'jmlBobot' => $jmlBobot]);
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
                ->whereIn('status', ['aktif', 'mangkir'])
                ->groupBy('id_kelas'),
            'jumlah_siswa',
            'jumlah_siswa.id_kelas',
            '=',
            'k.id_kelas'
        )
        ->distinct()
        ->get();
            //dd($kelas);
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
    public function edit_profile_siswa($id){
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
    public function edit_profile_ins($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        // counter agar instruktur lain engga mencoba get url dengan id instruktur lain
        $getEmail = instruktur::select("email_ins")->from("instrukturs")->where("id_ins",'=',$id)->first();
        // dd($getEmail);
        if($getEmail->email_ins != $email){
            return abort(403);
        }

        // get data instruktur
        $getData = DB::table("instrukturs as i")->select("i.*", "k.nama_kelas")
        ->join("kelas as k", 'k.id_ins','=',"i.id_ins")
        ->where("i.id_ins",'=',$id)->first();

        return view("instruktur.edit_profile.edit_profile")->with(["ins" => $getData]);
    }
    public function edit_profile_adm($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        // counter agar admin lain engga mencoba get url dengan id admin lain
        $getEmail = admin::select("email_adm")->from("admins")->where("id_adm",'=',$id)->first();
        // dd($getEmail);
        if($getEmail->email_adm != $email){
            return abort(403);
        }

        // get data admin
        $getData = DB::table("admins as i")->select("i.*")
        ->where("i.id_adm",'=',$id)->first();

        return view("admin.edit_profile.edit_profile")->with(["adm" => $getData]);
    }


    public function materiPembelajaran(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        
        $getIns = instruktur::where("email_ins",'=',$email)->first();
        $kelas = kelas::where("id_ins",'=',$getIns->id_ins)->first();
        
        if($kelas == false){
            return back()->with(["error_masuk" => "Instruktur belum terdapat kelas!"]);
        }
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
        $kelas = kelas::where("id_ins",'=',$getIns->id_ins)->first();
        if($kelas == false){
            return back()->with(["error_masuk" => "Instruktur belum terdapat kelas!"]);
        }
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
            ->leftJoin("jawabans", "soals.id_soal", "=", "jawabans.id_soal")
            ->where("kuis.id_kuis", '=', $id)
            ->orderBy("soals.id_soal",'ASC')
            ->get();
        //dd($getSoal);
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

        if (Carbon::now()->isWeekend()){
            return back()->with(['error_masuk' => "Menu daftar hadir ditutup pada akhir pekan!"]);
        }
        //cek status jadwal
        $getTglSelected = session('tanggal_selected');
        //dd($getTglSelected);
        if($getTglSelected != null){
            $getStatus = jadwal::select("j.*")
                ->from('jadwals as j')
                ->join("kelas as k",'k.id_kelas','=','j.id_kelas')
                ->where("k.id_ins",'=',$getId->id_ins)
                ->whereDate('j.tanggal_pelaksanaan', $getTglSelected)
                ->first();

        }else{
            $getStatus = jadwal::select("j.*")
            ->from('jadwals as j')
            ->join("kelas as k",'k.id_kelas','=','j.id_kelas')
            ->where("k.id_ins",'=',$getId->id_ins)
            ->whereDate('j.tanggal_pelaksanaan', Carbon::now()->toDateString())
            ->first();
        }
        // dd($getStatus);
        if($getStatus == false){
            return back()->with(['error_masuk' => "Instruktur belum terdapat kelas"]);
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
        if(session("listDaftarHadir") != null){
            return view("instruktur.absensi.absensi")->with(["siswa" => session("listDaftarHadir"), 'status' => $getStatus->status,'tglJadwal' => $getTglJadwal,'tanggal_selected_format' => session('tanggal_selected_format'), 'tanggal_selected' => session('tanggal_selected'),'id_jadwal' => $getStatus->id_jadwal]);
        }else{

            $siswa = siswa::select('s.*')
            ->from("siswas as s")
            ->join("kelas as k", "k.id_kelas", "=", "s.id_kelas")
            ->where("k.id_ins", "=", $getId->id_ins)
            ->get();
        
            // Ambil daftar hadir berdasarkan tanggal pelaksanaan
            if(session('tanggal_selected') == null){
                $getDaftarHadir = daftar_hadir::select('d.id_siswa', 'd.status_presensi')
                    ->from("daftar_hadirs as d")
                    ->join("jadwals as j", 'd.id_jadwal', '=', 'j.id_jadwal')
                    ->join("kelas as k", 'k.id_kelas', '=', 'j.id_kelas')
                    ->where("k.id_ins", '=', $getId->id_ins)
                    ->where("j.tanggal_pelaksanaan", '=', Carbon::now()->toDateString())
                    ->get();
                }else{
                $tanggalSelected = Carbon::parse(session('tanggal_selected'))->toDateString();
                $getDaftarHadir = daftar_hadir::select('d.id_siswa', 'd.status_presensi')
                    ->from("daftar_hadirs as d")
                    ->join("jadwals as j", 'd.id_jadwal', '=', 'j.id_jadwal')
                    ->join("kelas as k", 'k.id_kelas', '=', 'j.id_kelas')
                    ->where("k.id_ins", '=', $getId->id_ins)
                    ->where("j.tanggal_pelaksanaan", '=', $tanggalSelected)
                    ->get();
                    //dd($tanggalSelected);
            }
    
            foreach ($siswa as $siswas) {
                $statusPresensi = $getDaftarHadir->where('id_siswa', $siswas->id_siswa)->first();
                $siswas->status_presensi = $statusPresensi ? $statusPresensi->status_presensi : 'Belum Absen';
            }

            $getQr = jadwal::select("qrcode_path")->where("id_jadwal",'=', $getStatus->id_jadwal)->first();
            return view("instruktur.absensi.absensi")->with([
                "siswa" => null,
                "siswa2" => $siswa, 
                'status' => $getStatus->status,
                'tglJadwal' => $getTglJadwal, 
                'tanggal_selected_format' => session('tanggal_selected_format'), 
                'tanggal_selected' => session('tanggal_selected'),
                'id_jadwal' => $getStatus->id_jadwal,
                "qrcode" => $getQr->qrcode_path
            ]);
        }
    }

    public function viewAbsenSiswa($id){

        $role = session("role");
        $email = session("email");
        $sukses_absen = session()->get('sukses_absen');
        $error_absen = session()->get('error_absen');
        // dd($sessionAbsen);
        if($role != "siswa"){
            return abort(403);
        }
        // ini  buat ngecek biar siswa yang lain gabisa mencoba buka view absen dari id siswa yang lain
        $getID = siswa::where("email",'=',$email)->first();
        if($getID->id_siswa !== $id){
            return abort(403);
        }
        Carbon::setLocale('id');
        $absen = daftar_hadir::select("d.*",'j.tanggal_pelaksanaan')->from("daftar_hadirs as d")
        ->where('d.id_siswa','=',$id)
        ->join('jadwals as j','j.id_jadwal','=','d.id_jadwal')
        ->orderBy('j.tanggal_pelaksanaan', 'desc')
        ->get();
        $absen->transform(function ($item) {
            $item->formatted_date = Carbon::parse($item->tanggal_pelaksanaan)->translatedFormat('l, d F Y');
            return $item;
        });
        //dd($id);

        return view('siswa.absensi.absensi')->with(["absen" => $absen,'siswa' => $getID, 'error_absen' => $error_absen, 'sukses_absen' => $sukses_absen]);
    }

    public function viewMateri(){
        $role = session("role");
        if($role != "siswa" && $role != "admin"){
            return abort(403);
        }
        if($role == "siswa"){
            $email = session("email");
            $mapel = mapel::get();
            $materi = materi::select("mapels.id_mapel as id_mapels", 'materis.*')
                ->from("materis")
                ->join("mapels", 'mapels.id_mapel', '=', "materis.id_mapel")
                ->get();
            $siswa = siswa::where("email",'=',$email)->first();
            return view('siswa.mapel.mapel', [
                'mapel' => $mapel, 
                'materi' => $materi,
                'siswa' => $siswa,
            ]);
        }elseif($role == "admin"){
            $email = session("email");
            $mapel = mapel::get();
            $materi = materi::select("mapels.id_mapel as id_mapels", 'materis.*')
                ->from("materis")
                ->join("mapels", 'mapels.id_mapel', '=', "materis.id_mapel")
                ->get();
            $admin = admin::where("email_adm",'=',$email)->first();
            return view('admin.materi.mapel', [
                'mapel' => $mapel, 
                'materi' => $materi,
                'admin' => $admin,
            ]);
        }
    }
    

    public function view_kuis_siswa(){

        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return abort(403);
        }
        
        $siswa = siswa::where("email",'=',$email)->first();
        $kuis = kuis::select("k.*", "m.nama_mapel", "n.id_nilai_kuis")
        ->from("kuis as k")
        ->join("mapels as m", "m.id_mapel", "=", "k.id_mapel")
        ->leftJoin("nilai_kuis as n", function($join) use ($siswa) {
            $join->on("n.id_kuis", "=", "k.id_kuis")
                 ->where("n.id_siswa", "=", $siswa->id_siswa);
        })
        ->get();

        //dd($kuis);


        return view('siswa.kuis.kuis')->with(['kuis' => $kuis,'siswa' => $siswa]);

    }

    public function review_kuis_siswa(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur" && $role != "admin"){
            return abort(403);
        }
        
        if($role == 'instruktur'){
            $getIns = instruktur::where("email_ins",'=',$email)->first();
            //get id kelas yang diajar
            $kelas = kelas::where("id_ins",'=',$getIns->id_ins)->first();
            if($kelas == false){
                return back()->with(["error_masuk" => "Instruktur belum terdapat kelas!"]);
            }
            $getKuis = kuis::select("kuis.*",'mapels.nama_mapel')->from("kuis")->join("mapels",'mapels.id_mapel','=','kuis.id_mapel')->get();
            $getMapel = mapel::get();
            $getIns = instruktur::where("email_ins",'=',$email)->first();
            return view("instruktur.kuis.review")->with(["kuis" => $getKuis,'mapel' => $getMapel, "instruktur" => $getIns]);
        }elseif($role == "admin"){
            $getKuis = kuis::select("kuis.*",'mapels.nama_mapel')->from("kuis")->join("mapels",'mapels.id_mapel','=','kuis.id_mapel')->get();
            $getMapel = mapel::get();
            $admin = admin::where("email_adm",'=',$email)->first();
            return view("admin.kuis.review")->with(["kuis" => $getKuis,'mapel' => $getMapel, "admin" => $admin]);
        }
    }

    public function view_kuis_instruktur($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        if($role == 'instruktur'){
            //get data kuis2 yang dikerjain siswa sesuai id
            $getIns = instruktur::where("email_ins",'=',$email)->first();

            $getKelas = kelas::where("id_ins",'=',$getIns->id_ins)->first();
            $getKuis = kuis::select("kuis.*",'mapels.nama_mapel','n.*','siswas.nama')
            ->from("kuis")
            ->join("mapels",'mapels.id_mapel','=','kuis.id_mapel')
            ->join("nilai_kuis as n",'n.id_kuis','=','kuis.id_kuis')
            ->join("siswas",'siswas.id_siswa','=','n.id_siswa')
            ->where('kuis.id_kuis','=',$id)
            ->where('siswas.id_kelas','=',$getKelas->id_kelas)
            ->get();
            //dd($getKuis);
            $namaKuis = kuis::where("id_kuis", $id)->first();
            //dd($getKuis);

            return view("instruktur.kuis.listKuis")->with(['judulKuis' => $namaKuis,'kuis' => $getKuis,'instruktur' => $getIns]);
        }
    }
    public function view_kuis_admin($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        //get data kuis2 yang dikerjain siswa sesuai id
        $getKuis = kuis::select("kuis.*",'mapels.nama_mapel','n.*','siswas.nama')
        ->from("kuis")
        ->join("mapels",'mapels.id_mapel','=','kuis.id_mapel')
        ->join("nilai_kuis as n",'n.id_kuis','=','kuis.id_kuis')
        ->join("siswas",'siswas.id_siswa','=','n.id_siswa')
        ->where('kuis.id_kuis','=',$id)
        ->get();

        $namaKuis = kuis::where("id_kuis", $id)->first();
        //dd($getKuis);
        $admin = admin::where("email_adm",'=',$email)->first();

        return view("admin.kuis.listKuis")->with(['judulKuis' => $namaKuis,'kuis' => $getKuis,'admin' => $admin,'id' => $id]);

    }

    public function halaman_penilaian(){
        $role = session("role");
        $email = session("email");
        
        if($role != "instruktur"){
            return abort(403);
        }
        $getIns = instruktur::where("email_ins",'=',$email)->first();
        //get id kelas yang diajar
        $kelas = kelas::where("id_ins",'=',$getIns->id_ins)->first();
        if($kelas == false){
            return back()->with(["error_masuk" => "Instruktur belum terdapat kelas!"]);
        }
        // get data komp nilai
        $kompNilai = kompNilai::get();
        // get data siswa dari table nilai siswa yang diajar
        $datasiswa = siswa::where("id_kelas",'=',$kelas->id_kelas)->get();
        // get data nilai dari masing2 siswa nya
        $nilaiSiswa = nilai::orderBy('id_komp_nilai')->get();
        return view("instruktur.penilaian.nilai")->with(['instruktur' => $getIns,'komponen_nilai' => $kompNilai,'datasiswa' => $datasiswa,'nilaiSiswa' => $nilaiSiswa]);

    }


    public function halamanAbsensiAdmin(){
        //get kelas
        $kelas = kelas::get();
        return view('admin.presensi.absensi')->with(['tanggal_selected' => null,'kelas' => $kelas,'tglJadwal' => null,'siswa' => null]);
    }

    public function halamanAbsensiAdminKelas($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        Carbon::setLocale('id');
        $getTglJadwal = jadwal::select(
            'j.tanggal_pelaksanaan',
            'j.tanggal_pelaksanaan as tanggal' // Tambahkan kolom tanggal dengan nama alias
        )
        ->from('jadwals as j')
        ->join('kelas as k', 'k.id_kelas', '=', 'j.id_kelas')
        ->where("k.id_kelas",'=',$id)
        ->get()
        ->map(function ($item) {
            $tanggal = Carbon::parse($item->tanggal_pelaksanaan);
            $item->tanggal = $tanggal->translatedFormat('l, d F Y'); // Format tanggal baru
            return $item;
        });

        $kelas = kelas::get();
        $kelasSelected = kelas::where('id_kelas','=',$id)->first();

        // get data kelas
        return view('admin.presensi.absensi')->with(['tanggal_selected' => null,'kelas' => $kelas,'kelasSelected' => $kelasSelected,'tglJadwal' => $getTglJadwal,'siswa' => null]);

    }

    public function halamanAbsensiAdminKelasTgl($id_kelas,$tgl){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        Carbon::setLocale('id');
        $getTglJadwal = jadwal::select(
            'j.tanggal_pelaksanaan',
            'j.tanggal_pelaksanaan as tanggal' // Tambahkan kolom tanggal dengan nama alias
        )
        ->from('jadwals as j')
        ->join('kelas as k', 'k.id_kelas', '=', 'j.id_kelas')
        ->where("k.id_kelas",'=',$id_kelas)
        ->get()
        ->map(function ($item) {
            $tanggal = Carbon::parse($item->tanggal_pelaksanaan);
            $item->tanggal = $tanggal->translatedFormat('l, d F Y'); // Format tanggal baru
            return $item;
        });

        $kelas = kelas::get();
        $kelasSelected = kelas::where('id_kelas','=',$id_kelas)->first();

        $siswa = siswa::select('s.*')
        ->from("siswas as s")
        ->join("kelas as k", "k.id_kelas", "=", "s.id_kelas")
        ->where("k.id_kelas", "=", $id_kelas)
        ->get();
    
        // Ambil daftar hadir berdasarkan tanggal pelaksanaan
        $getDaftarHadir = daftar_hadir::select('d.id_siswa', 'd.status_presensi')
            ->from("daftar_hadirs as d")
            ->join("jadwals as j", 'd.id_jadwal', '=', 'j.id_jadwal')
            ->join("kelas as k", 'k.id_kelas', '=', 'j.id_kelas')
            ->where("k.id_kelas", "=", $id_kelas)
            ->where("j.tanggal_pelaksanaan", '=', $tgl)
            ->get();
            
        foreach ($siswa as $siswas) {
            $statusPresensi = $getDaftarHadir->where('id_siswa', $siswas->id_siswa)->first();
            $siswas->status_presensi = $statusPresensi ? $statusPresensi->status_presensi : 'Belum Absen';
        }

        // get id jadwal sesuai id kelas dan jadwal yang dipilih
        $getStatus = jadwal::select("j.*")
            ->from('jadwals as j')
            ->join("kelas as k",'k.id_kelas','=','j.id_kelas')
            ->where("k.id_kelas", "=", $id_kelas)
            ->whereDate('j.tanggal_pelaksanaan', $tgl)
            ->first();
        //dd($getStatus->status);
        return view('admin.presensi.absensi')->with(['tanggal_selected' => $tgl,'id_jadwal' => $getStatus->id_jadwal,'status_jadwal' => $getStatus->status,'kelas' => $kelas,'kelasSelected' => $kelasSelected,'tglJadwal' => $getTglJadwal,'siswa' => $siswa]);
    }

    public function dataMateri(){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
    
        // Ambil data mapel dan materi
        $mapel = mapel::get();
        $materi = materi::select("mapels.id_mapel as id_mapels", 'materis.*')
            ->from("materis")
            ->join("mapels", 'mapels.id_mapel', '=', "materis.id_mapel")
            ->get();
        $siswa = siswa::where("email",'=',$email)->first();
        return view('siswa.mapel.mapel', [
            'mapel' => $mapel, 
            'materi' => $materi,
            'siswa' => $siswa,
        ]);
    }

    public function halaman_transkip_siswa($id_siswa){
        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return abort(403);
        }
        $siswa = siswa::where("email",'=',$email)->first();
        //get data nilai
        $nilai = nilai::select("s.nama",'k.*','n.*')
        ->from('nilais as n')
        ->join("siswas as s",'s.id_siswa','=','n.id_siswa')
        ->join("komp_nilais as k",'k.id_komp_nilai','=','n.id_komp_nilai')
        ->where("s.id_siswa",'=',$id_siswa)->get();

        if($nilai->isEmpty()){
            $komp = kompNilai::get();
            
            return view('siswa.penilaian.penilaian')->with(['siswa' => $siswa,'nilai' => null, 'komp' => $komp]);
        }else{
            //dd($nilai);
            return view('siswa.penilaian.penilaian')->with(['siswa' => $siswa,'nilai' => $nilai]);
        }
    }

    public function halamanLaporanBulanan(){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        $kelas = kelas::get();
        return view('admin.presensi.laporan_bulanan.laporanBulanan')
            ->with(['tanggal_selected' => null,'kelas' => $kelas,'tglJadwal' => null,
        ]);
    }


    public function halaman_scan(){
        $role = session("role");
        $email = session("email");
        
        if($role != "siswa"){
            return abort(403);
        }
        $getId = siswa::where("email",'=',$email)->first();
        return view('siswa.absensi.scanQR')->with(["id" => $getId->id_siswa]);

    }
}
