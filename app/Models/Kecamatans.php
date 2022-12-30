<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatans extends Model
{
    use HasFactory;

    protected $fillable = [
        'kecamatan',
    ];
    
    protected $primaryKey = 'id_kecamatan';
}
