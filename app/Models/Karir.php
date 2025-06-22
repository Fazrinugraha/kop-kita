<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    use HasFactory;

    protected $table = "profil_kop_karir";     // Nama tabel
    protected $primaryKey = "id_karir";        // Primary key custom
    public $incrementing = true;               // Auto increment (default true)
    protected $keyType = 'int';                // Tipe primary key

    protected $fillable = [                    // Kolom-kolom yang boleh diisi
        'judul_posisi',
        'divisi',
        'penempatan',
        'deskripsi',
        'kualifikasi',
        'benefit',
        'batas_lamar',
        'kuota',
        'status',
        'dokumen_syarat'
    ];
}
