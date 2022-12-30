<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kecamatans;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    public function index(){
        return view('dashboard.kecamatans.index');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'kecamatan' => 'required|string|unique:kecamatans,kecamatan'
        ]);
     
        if ($validator->passes()) {
            $kecamatan              = new Kecamatans();
            $kecamatan->kecamatan   = $request->kecamatan;
            
            if ($kecamatan->save()){
                return response()->json(['success'=>'Data berhasil ditambahkan.']);
            }
            return response()->json(['error'=>'Data gagal ditambahkan.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function update(Request $request, $kecamatan){
        $validator = Validator::make($request->all(), [
            'kecamatan' => 'required|string|unique:kecamatans,kecamatan,'.$kecamatan.',id_kecamatan'
        ]);

        if ($validator->passes()){
            $kecamatan              = Kecamatans::where('id_kecamatan', $kecamatan)->first();
            $kecamatan->kecamatan   = $request->kecamatan;

            if($kecamatan->save()){
                return response()->json(['success'=>'Data berhasil dirubah.']);
            }

            return response()->json(['error'=>$validator->errors()->all()]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function destroy($kecamatan){
        $kecamatan = Kecamatans::where('id_kecamatan', $kecamatan)->first();

        if($kecamatan != null){
            try{
                $kecamatan->delete();
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        return false;
    }
}
