<?php

namespace App\Http\Controllers;

use App\Models\instruktur;
use App\Models\kelas;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class kelasController extends Controller
{
    //
    public function add_kelas(Request $request){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        $kelas = $request->kelas;
        $kuota = $request->kuota;
        if (trim($kelas) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi!"]);
        }
        if ($kuota == 0) {
            return back()->with(["error_add" => "Kuota tidak boleh 0"]);
        }
        $cekKelas = kelas::where("nama_kelas",'=',$kelas)->first();
        
        if($cekKelas == true){
            return back()->with(['error_add' => "Nama kelas sudah tersedia"]);
        }

        $insertKelas = DB::table("kelas")->insert([
            "nama_kelas" => $kelas,
            "kuota_siswa" => $kuota,
        ]);
        if($insertKelas == true){
            //get id kelas yang udah ditambah barusan
            $getIdKelas = kelas::where("nama_kelas",'=',$kelas)->first();
            //menambah data jadwal selama setahun dari kelas ditambahkan
            if ($getIdKelas == true) {
                $id_kelas = $getIdKelas->id_kelas;
                $startDate = Carbon::now(); // Tanggal mulai (hari ini)
                $endDate = Carbon::now()->addYear(); // Tanggal berakhir (1 tahun ke depan)
            
                $currentDate = $startDate;
                $data = []; // Array untuk menyimpan data batch insert
            
                while ($currentDate->lte($endDate)) {
                    // Cek apakah hari ini adalah Senin-Jumat
                    if ($currentDate->isWeekday()) {
                        $data[] = [
                            'id_jadwal' => 'JDWL' . $currentDate->format('y') . $currentDate->format('m') . $currentDate->format('d'). $id_kelas,
                            'id_kelas' => $id_kelas,
                            'tanggal_pelaksanaan' => $currentDate->format('Y-m-d'),
                            'status' => 'aktif', // Ubah status sesuai kebutuhan
                        ];
                    }
                    $currentDate->addDay(); // Tambahkan 1 hari
                }
                $insertJadwal = DB::table('jadwals')->insert($data);
                if($insertJadwal == true){
                    return back()->with(['sukses_add' => "Berhasil menambah kelas"]);
                }else{
                    return back()->with(['error_add' => "Gagal menambah kelas"]);
                }
            }
        }else{
            return back()->with(['error_add' => "Gagal menambah kelas"]);
        }
    }

    public function edit_kelas(Request $request){
        $id = $request->kelass;
        $kelas = $request->kelas;
        $kuota = $request->kuota;
        $ins = $request->ins;
        if (trim($kelas) === '') {
            return back()->with(["error_add" => "Input tidak boleh kosong atau hanya berisi spasi"]);
        }
        if ($kuota == 0) {
            return back()->with(["error_add" => "Kuota tidak boleh 0"]);
        }
        $cekKelas = kelas::where("nama_kelas",'=',$kelas)->where("id_kelas",'!=',$id)->first();
        
        if($cekKelas == true){
            return back()->with(['error_add' => "Nama kelas sudah tersedia"]);
        }
        
        // mengecek jumlah siswa yang ada di kelas
        $cekjmlsiswa = siswa::where("id_kelas",'=',$id)->whereIn('status', ['aktif', 'mangkir'])->count();
        //dd($cekjmlsiswa);
        if($kuota < $cekjmlsiswa){
            return back()->with(['error_add' => "Kuota tidak boleh kurang dari jumlah siswa yang ada di kelas"]);
        }

        // cek instuktur yang dipake udah dipake di kelas lain apa belom
        $cekIns = kelas::where("id_ins",'=',$ins)->where("id_kelas",'!=',$id)->first();
        if($cekIns == true){
            return back()->with(['error_add' => "Instruktur telah mengampu kelas lain"]);

        }
        // dd($ins);
        $updateKelas = DB::table("kelas")->where("id_kelas",'=',$id)->update([
            "nama_kelas" => $kelas,
            "kuota_siswa" => $kuota,
            "id_ins" => $ins,
        ]);
        if($updateKelas == true){
            return back()->with(['sukses_add' => "Berhasil mengubah kelas"]);
        }else{
            return back()->with(['error_add' => "Gagal mengubah kelas"]);
        }
    }

    public function delete_kelas($id){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        // cek apakah ada siswa yang berada di kelas ini
        $cekSiswa = siswa::where("id_kelas",'=',$id)->first();
        if($cekSiswa == true){
            return back()->with(['error_delete' => "Terdapat Siswa"]);
        }

        //menghapus jadwal terlebih dahulu
        $deleteJadwal = DB::table("jadwals")->where("id_kelas",'=',$id)->delete();
        if($deleteJadwal == true){
            $delete = DB::table('kelas')->where("id_kelas",'=',$id)->delete();
            if($delete == true){
                return back()->with(['sukses_delete' => "Berhasil menghapus kelas"]);
            }else{
                return back()->with(['error_delete' => "Berhasil menghapus kelas"]);
            }
        }else{
            return back()->with(['error_delete' => "Berhasil menghapus kelas"]);
        }
    }

    public function detail_kelas($id){

        
        // menampilkan data kelas berupa siswa dan guru
        $kelas = kelas::select("k.*",'s.nama','s.status')
        ->from('kelas as k')
        ->join("siswas as s",'s.id_kelas','=','k.id_kelas')
        ->where("k.id_kelas",'=',$id)
        ->get();
        $kelasNins = kelas::select('i.nama_ins','k.nama_kelas')
        ->from('kelas as k')
        ->leftJoin("instrukturs as i",'i.id_ins','=','k.id_ins')
        ->where("k.id_kelas",'=',$id)
        ->first();

        return view('admin.kelola_kelas.detail')->with(["kelas" => $kelas,'kelasNins' => $kelasNins]);
    }
}
