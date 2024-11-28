<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals'; // Nama tabel
    protected $primaryKey = 'id_jadwal'; // Primary key jika berbeda dari default
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'string'; // Jika primary key bukan integer
    public $timestamps = false; //
}
