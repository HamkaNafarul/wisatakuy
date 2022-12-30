<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'nilai',
        'date',
        'id_objek_wisata',
        'id_user'
    ];
    
    protected $primaryKey = 'id_rating';
}
