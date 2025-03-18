<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_hadirs', function (Blueprint $table) {
            $table->integer('id_presensi',11)->primary();
            $table->string('id_siswa',10);
            $table->string('status_presensi',15);
            $table->string('id_jadwal',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_hadirs');
    }
};
