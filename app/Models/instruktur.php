<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instruktur extends Model
{
    use HasFactory;

    protected $tabel = 'instrukturs';

    // Menentukan Primary Key pada tabel
    protected $primaryKey = 'id_ins';

    // Menentukan kolom yang dapat diisi pada tabel
    protected $fillable = [
        'id_ins', 
        'nama_ins', 
        'email_ins', 
        'no_hp_ins',
        'alamat_ins',
        'tgl_masuk_ins',
        'id_akun',
    ] ;

    public $incrementing = false;
    public $timestamps = false;  
}
