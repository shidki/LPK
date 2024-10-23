<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $tabel = 'siswas';

    // Menentukan Primary Key pada tabel
    protected $primaryKey = 'id';

    // Menentukan kolom yang dapat diisi pada tabel
    protected $fillable = [
        'id_siswa', 
        'nama', 
        'email', 
        'no_hp',
        'alamat',
        'tgl_masuk',
        'tgl_lulus',
        'id_akun',
        'id_bidang',
        'id_kelas',
        'status',
    ] ;

    public $incrementing = false;
    public $timestamps = false;  
}
