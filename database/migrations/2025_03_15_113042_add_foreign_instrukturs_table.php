<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instrukturs', function (Blueprint $table) {
            // $table->integer('id_akun')->nullable()->change();
            $table->foreign('id_akun')->references('id_akun')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('instrukturs', function (Blueprint $table) {
            $table->dropForeign(['id_akun']);
            // $table->integer('id_akun')->nullable()->change();
        });
    }
};
