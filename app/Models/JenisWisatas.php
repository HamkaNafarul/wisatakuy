<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisWisatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
    ];
    
    protected $primaryKey = 'id_jenis_wisata';
}
