<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manfaat extends Model
{
    use HasFactory;

    protected $table = 'profil_kop_manfaat';
    protected $primaryKey = 'id_manfaat';
    public $incrementing = true;
    protected $keyType = 'int';
}
