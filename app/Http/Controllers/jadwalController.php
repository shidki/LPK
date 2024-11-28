<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;

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


        return view("admin.jadwal.jadwal")->with(['jadwal' => $dataJadwal->toArray(),'kelas' => $getKelas->nama_kelas]);
    }
}
