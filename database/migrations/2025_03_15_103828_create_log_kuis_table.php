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
        Schema::create('log_kuis', function (Blueprint $table) {
            $table->integer('id_log',5)->primary();
            $table->string('id_kuis',15);
            $table->time('start_time');
            $table->string('id_siswa',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_kuis');
    }
};
