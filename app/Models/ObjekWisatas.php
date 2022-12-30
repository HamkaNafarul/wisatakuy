<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'kecamatan',
        'jenis_wisata',
        'deskripsi',
        'latitude_Y',
        'longitude_X',
        'harga',
        'id_gambar',
    ];
    
    protected $primaryKey = 'id_objek_wisata';
}
