<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    use HasFactory;
    protected $table = "profil_kop_regulasi";
    protected $fillable = ['nama_regulasi', 'file_dokumen'];
}
