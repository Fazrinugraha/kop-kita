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
        'jenis_media',
        'media_path',
        'deskripsi',
    ];
}
