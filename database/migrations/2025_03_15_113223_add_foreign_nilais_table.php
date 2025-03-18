<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            // $table->string('id_siswa',15)->change();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');

            // $table->integer('id_komp_nilai')->change();
            $table->foreign('id_komp_nilai')->references('id_komp_nilai')->on('komp_nilais')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign(['id_siswa']);
            // $table->string('id_siswa',15)->change();
            
            $table->dropForeign(['id_komp_nilai']);
            // $table->integer('id_komp_nilai')->change();
            
        });
    }
};
