<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GambarObjeks extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'keterangan'
    ];

    protected $primaryKey = 'id_gambar_objek';

    public function setGambar($value)
    {
        $this->attributes['gambar'] = urlencode($value);
    }
}
