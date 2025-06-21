<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    // Menentukan nama tabel secara eksplisit
    protected $table = 'profil_kop_visi_misis';
    protected $fillable = [
        'jenis',
        'isi',
        'urutan',
    ];
}
