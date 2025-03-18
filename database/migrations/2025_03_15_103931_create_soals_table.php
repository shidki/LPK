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
        Schema::create('soals', function (Blueprint $table) {
            $table->integer('id_soal',11)->primary();
            $table->text('pertanyaan');
            $table->text('gambar_path')->nullable();
            $table->text('audio_path')->nullable();
            $table->string('type_soal',10);
            $table->string('id_kuis',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
