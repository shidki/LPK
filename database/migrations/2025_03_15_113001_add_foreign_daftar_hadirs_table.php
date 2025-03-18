<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daftar_hadirs', function (Blueprint $table) {
            // $table->string('id_jadwal')->change();
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwals')->onDelete('cascade');

            // $table->string('id_siswa')->change();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('daftar_hadirs', function (Blueprint $table) {
            $table->dropForeign(['id_jadwal']);
            // $table->string('id_jadwal', 255)->change();
            
            
            $table->dropForeign(['id_siswa']);
            // $table->string('id_siswa', 10)->change();
        });
    }
};
