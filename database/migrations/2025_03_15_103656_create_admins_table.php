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
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id_adm',11)->primary();
            $table->string('nama_adm',50);
            $table->string('email_adm',50);
            $table->text('alamat_adm');
            $table->string('no_hp_adm', 25);
            $table->date('tgl_masuk_adm');
            $table->integer('id_akun')->nullable();
            $table->foreign('id_akun')->references('id_akun')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
