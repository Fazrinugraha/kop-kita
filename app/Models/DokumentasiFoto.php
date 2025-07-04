<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiFoto extends Model
{
    protected $table = 'profil_kop_dokumentasi_foto';

    protected $fillable = ['dokumentasi_id', 'file_path'];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'dokumentasi_id');
    }
}
