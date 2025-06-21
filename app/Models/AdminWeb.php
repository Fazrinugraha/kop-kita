<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminWeb extends Authenticatable
{
    use HasFactory;
    protected $table = "profil_kop_admin_web";
    protected $primaryKey = 'id_admin_web';
}
