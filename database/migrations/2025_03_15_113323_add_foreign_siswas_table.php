<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            // $table->integer('id_akun')->nullable()->change();
            $table->foreign('id_akun')->references('id_akun')->on('users')->onDelete('cascade');

            // $table->integer('id_bidang')->change();
            $table->foreign('id_bidang')->references('id_bidang')->on('bidang_minats')->onDelete('cascade');

            // $table->integer('id_kelas')->change();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['id_akun']);
            // $table->integer('id_akun')->nullable()->change();
            
            $table->dropForeign(['id_bidang']);
            // $table->integer('id_bidang')->change();
            
            $table->dropForeign(['id_kelas']);
            // $table->integer('id_kelas')->change();
        });
    }
};
