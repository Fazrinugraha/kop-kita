<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;
    protected $table = "profil_kop_pengabdian";
    protected $primaryKey = 'id_pengabdian';
}
