<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JenisWisatas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriPariwisataController extends Controller
{
    public function index(){
        return view('dashboard.pariwisatas.kategoris.index');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string|unique:jenis_wisatas,jenis'
        ]);
     
        if ($validator->passes()) {
            $jenis          = new JenisWisatas();
            $jenis->jenis   = $request->jenis;
            
            if ($jenis->save()){
                return response()->json(['success'=>'Data berhasil ditambahkan.']);
            }

            return response()->json(['error'=>'Data gagal ditambahkan.']);
        }
     
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function update(Request $request, $kategori){
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string|unique:jenis_wisatas,jenis,'.$kategori.',id_jenis_wisata'
        ]);

        if ($validator->passes()){
            $jenis = JenisWisatas::where('id_jenis_wisata', $kategori)->first();
            $jenis->jenis   = $request->jenis;

            if($jenis->save()){
                return response()->json(['success'=>'Data berhasil dirubah.']);
            }

            return response()->json(['error'=>$validator->errors()->all()]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function destroy($kategori){
        $jenis = JenisWisatas::where('id_jenis_wisata', $kategori)->first();

        if($jenis != null){
            try{
                $jenis->delete();
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        return false;
    }
}
