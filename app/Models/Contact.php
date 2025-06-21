<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Ganti nama tabel default dengan tabel baru
    protected $table = 'profil_kop_contacts';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'subject',
        'message'
    ];
}
