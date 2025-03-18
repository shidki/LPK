<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    use HasFactory;
    protected $table = 'soals'; // Pastikan nama tabel sudah sesuai

    protected $fillable = [
        'pertanyaan', 
        'type_soal', 
        'id_kuis', 
        'gambar_path', 
        'audio_path'
    ];
}
