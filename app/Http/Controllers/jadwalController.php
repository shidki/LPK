<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class jadwalController extends Controller
{
    //
    public function view_jadwal($namaKelas){
        $role = session("role");
        $email = session("email");
        
        if($role != "admin"){
            return abort(403);
        }
        //getIdKelas
        
        $getKelas = kelas::where("nama_kelas",'=',$namaKelas)->first();
        // get data jadwal sesuai id kelas
        $getJadwal = jadwal::where("id_kelas", '=', $getKelas->id_kelas)
        ->get();

        $dataJadwal = $getJadwal->map(function ($jadwal) {
            // Menggunakan Carbon untuk memformat tanggal
            $jadwal->tanggal_format = Carbon::parse($jadwal->tanggal_pelaksanaan)->locale('id')->isoFormat('dddd, D MMMM YYYY');
            return $jadwal;
        });


        return view("admin.jadwal.jadwal")->with(['jadwal' => $dataJadwal->toArray(),'kelas' => $getKelas]);
    }

    public function jadwalLibur($id){
        // cek status jadwal yang dirubah ( klo udah dimulai / selesai dia gabisa dirubah tiba2 libur)
        $cekStatus = jadwal::where("id_jadwal",'=',$id)->first();
        if($cekStatus->status == "mulai" || $cekStatus->status == "selesai"){
            return back()->with(["error_edit" => "Jadwal telah dimulai atau telah selesai!"]);
        }
        if($cekStatus->status == "libur"){
            $editStatus = DB::table("jadwals")->where("id_jadwal",'=',$id)->update([
                "status" => "aktif"
            ]);
            if($editStatus == true){
                return back()->with(["sukses_edit" => "Jadwal berhasil diubah!"]);
            }else{
                return back()->with(["error_edit" => "Jadwal gagal diubah!"]);
            }
        }elseif($cekStatus->status == "aktif"){
            $editStatus = DB::table("jadwals")->where("id_jadwal",'=',$id)->update([
                "status" => "libur"
            ]);
            if($editStatus == true){
                return back()->with(["sukses_edit" => "Jadwal berhasil diubah!"]);
            }else{
                return back()->with(["error_edit" => "Jadwal gagal diubah!"]);
            }
        }
    }
    public function tambahJadwal($id)
    {
        // Ambil tanggal sekarang
        $currentDate = Carbon::now();
        
        // Cek tanggal terakhir jadwal pada kelas
        $lastScheduleDate = jadwal::where('id_kelas', $id)
                                ->orderBy('tanggal_pelaksanaan', 'desc')
                                ->first();
        
        if ($lastScheduleDate) {
            // Ambil tanggal terakhir pelaksanaan jadwal
            $lastDate = Carbon::parse($lastScheduleDate->tanggal_pelaksanaan);
            $lastDate2 = Carbon::parse($lastScheduleDate->tanggal_pelaksanaan);
            // Dapatkan tanggal satu bulan sebelum tanggal terakhir jadwal kelas
            $oneMonthBeforeLastDate = $lastDate->subMonth();

            
            //$lastDate3 = $lastDate2->copy()->addDay();

            //// cek apakah jadwal sudah ditambah atau belum
            //$cekJadwal = jadwal::where("id_kelas",'=',$id)->where("tanggal_pelaksanaan",'=',$lastDate3)->first();
            //if($cekJadwal == true){
            //    return back()->with(['error_add' => "Jadwal telah tersedia!"]);
            //}


            //dd($lastDate2);      
            // Periksa apakah tanggal sekarang berada dalam rentang satu bulan sebelum tanggal terakhir hingga tanggal terakhir
            if ($currentDate->greaterThanOrEqualTo($oneMonthBeforeLastDate) && $currentDate->lessThanOrEqualTo($lastDate)) {
                // Jika tanggal tidak berada dalam rentang tersebut
                $currentDate = $lastDate2;  // Set tanggal saat ini ke tanggal terakhir jadwal
                $currentDate = $currentDate->addDay();  // Tambahkan 1 hari untuk mulai dari besok
                
                $endDate = $currentDate->copy()->addYear();  // Tambahkan satu tahun dari tanggal terakhir
                


                $data = [];
                
                while ($currentDate->lte($endDate)) {
                    // Cek apakah hari ini adalah Senin-Jumat
                    if ($currentDate->isWeekday()) {
                        $data[] = [
                            'id_jadwal' => 'JDWL' . $currentDate->format('y') . $currentDate->format('m') . $currentDate->format('d') . $id,
                            'id_kelas' => $id,
                            'tanggal_pelaksanaan' => $currentDate->format('Y-m-d'),
                            'status' => 'aktif', // Status jadwal
                        ];
                    }
                
                    // Tambahkan 1 hari setelah setiap iterasi
                    $currentDate->addDay();
                }
                $insertJadwal = DB::table('jadwals')->insert($data);
                if($insertJadwal == true){
                    return back()->with(['sukses_add' => "Jadwal berhasil diubah!"]);
                }else{
                    return back()->with(['error_add' => "Jadwal gagal diubah!"]);
                }
            } else {
                
                return back()->with(['error_add' => "Jadwal hanya bisa ditambah 1 bulan sebelum jadwal berakhir!"]);
            }
        } else {
            return back()->with(['error_add' => "Jadwal gagal ditambahkan!"]);

        }
    }
}
