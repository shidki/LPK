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
        Schema::create('riwayat_pengerjaans', function (Blueprint $table) {
            $table->integer('id_riwayat',11)->primary();
            $table->string('id_kuis',15);
            $table->integer('id_soal');
            $table->text('jawaban');
            $table->string('status',5)->nullable();
            $table->string('id_siswa',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pengerjaans');
    }
};
