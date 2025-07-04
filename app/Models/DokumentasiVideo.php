<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiVideo extends Model
{
    protected $table = 'profil_kop_dokumentasi_video';

    protected $fillable = ['dokumentasi_id', 'media_path', 'tipe', 'is_preview'];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'dokumentasi_id');
    }
}
