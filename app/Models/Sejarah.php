<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    // Menyesuaikan nama tabel di database
    protected $table = 'profil_kop_sejarahs';
    protected $fillable = ['tahun', 'judul', 'deskripsi', 'file_gambar'];
}
