<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiMedia extends Model
{
    use HasFactory;

    protected $table = 'profil_kop_dokumentasi_media';

    protected $fillable = [
        'dokumentasi_id',
        'jenis_media',
        'media_path',
    ];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'dokumentasi_id');
    }
}
