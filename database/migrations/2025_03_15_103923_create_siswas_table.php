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
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('id_siswa',15)->primary();
            $table->string('nama',50);
            $table->string('email',50);
            $table->string('no_hp',25);
            $table->text('alamat');
            $table->date('tgl_masuk');
            $table->date('tgl_lulus')->nullable();
            $table->integer('id_akun')->nullable();
            $table->integer('id_bidang');
            $table->integer('id_kelas');
            $table->string('status',25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
