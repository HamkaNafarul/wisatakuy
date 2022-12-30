<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ObjekWisatas;
use App\Models\Ulasans;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main(){
        $wisatas    = ObjekWisatas::all();
        $jumlah_pengguna    = User::count();
        $jumlah_ulasan  = Ulasans::count();
        return view('dashboard.main')
            ->with('wisatas', $wisatas)
            ->with('jumlah_pengguna', $jumlah_pengguna)
            ->with('jumlah_ulasan', $jumlah_ulasan);
    }
}
