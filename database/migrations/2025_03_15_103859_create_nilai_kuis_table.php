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
        Schema::create('nilai_kuis', function (Blueprint $table) {
            $table->integer('id_nilai_kuis',11)->primary();
            $table->string('id_kuis',15);
            $table->integer('nilai_fix')->nullable();
            $table->integer('nilai_sementara')->nullable();
            $table->string('id_siswa',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_kuis');
    }
};
