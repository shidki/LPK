<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "email"=> "lpk.ciptakerja01@gmail.com",
            "password" => Hash::make("admin123"),
            "role" => "admin",
            "status_akun" => "aktif"
        ]);
        $getAkun = DB::table("users")->where("email","lpk.ciptakerja01@gmail.com")->first();
        DB::table("admins")->insert([
            "nama_adm" => "master admin",
            "email_adm" => $getAkun->email,
            "alamat_adm" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil a accusantium dignissimos, perspiciatis dolorem accusamus et nisi mollitia ex nobis.",
            "no_hp_adm" => "+621325835578",
            "tgl_masuk_adm" => Carbon::now(),
            "id_akun" => $getAkun->id_akun,
        ]);
    }
}
