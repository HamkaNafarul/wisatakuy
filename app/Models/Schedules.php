<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_objek_wisata',
        'date',
        'jumlah_orang',
        'total_anggaran', 
        'kode'
    ];
    
    protected $primaryKey = 'id_schedule';
}
