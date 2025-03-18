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
        Schema::create('instrukturs', function (Blueprint $table) {
            $table->string('id_ins',5)->primary();
            $table->string('nama_ins',50);
            $table->string('email_ins',50);
            $table->string('no_hp_ins',25);
            $table->text('alamat_ins');
            $table->date('tgl_masuk_ins');
            $table->integer('id_akun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrukturs');
    }
};
