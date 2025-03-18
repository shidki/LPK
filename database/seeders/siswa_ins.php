<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class siswa_ins extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("users")->insert([
            "email"=> "ins1@ins.com",
            "password" => Hash::make("ins1"),
            "role" => "instruktur",
            "status_akun" => "aktif"
        ]);

        $getAkunIns = DB::table("users")->where("email","=","ins1@ins.com")->first();
        DB::table("instrukturs")->insert([
            "id_ins" => "Ins1",
            "nama_ins"=> "ins 1",
            "email_ins"=> "ins1@ins.com",
            "no_hp_ins" => "8907867862",
            "alamat_ins"=> "tempest raya",
            "tgl_masuk_ins" => Carbon::now(),
            "id_akun"=> $getAkunIns->id_akun,
        ]);
    }
}
