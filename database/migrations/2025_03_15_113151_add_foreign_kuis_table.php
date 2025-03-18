<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kuis', function (Blueprint $table) {
            // $table->string('id_mapel',15)->change();
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropForeign(['id_mapel']);
            // $table->string('id_mapel',15)->change();
            
        });
    }
};
