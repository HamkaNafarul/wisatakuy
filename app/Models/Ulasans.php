<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasans extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'ulasan',
        'gambar',
        'date',
        'id_user',
        'id_objek_wisata'
    ];
    
    protected $primaryKey = 'id_ulasan';
}
