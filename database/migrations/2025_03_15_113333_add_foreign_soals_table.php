<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            // $table->string('id_kuis',15)->change();
            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropForeign(['id_kuis']);
            // $table->string('id_kuis',15)->change();
        });
    }
};
