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
        Schema::create('komp_nilais', function (Blueprint $table) {
            $table->integer('id_komp_nilai')->primary();
            $table->string('nama_komp_nilai',50);
            $table->float('proposi_nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komp_nilais');
    }
};
