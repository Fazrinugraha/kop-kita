<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'profil_kop_dokumentasi';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
    ];

    // Relasi baru ke tabel foto
    public function foto()
    {
        return $this->hasMany(DokumentasiFoto::class, 'dokumentasi_id');
    }

    // Relasi baru ke tabel video
    public function video()
    {
        return $this->hasMany(DokumentasiVideo::class, 'dokumentasi_id');
    }
}
