<?php

namespace App\Http\Controllers\Wisata;

use App\Http\Controllers\Controller;
use App\Models\Ulasans;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ulasans = Ulasans::select('ulasans.*', 'users.name as nama_pengguna', 'objek_wisatas.nama as nama_pariwisata')
        ->join('users', 'ulasans.id_user', '=', 'users.id')
        ->join('objek_wisatas', 'ulasans.id_objek_wisata', '=', 'objek_wisatas.id_objek_wisata')
        ->orderBy('ulasans.created_at', 'DESC')->paginate(8);
        return view('pages.wisatas.ulasan', ['ulasans'=>$ulasans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_user= Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'id_objek_wisata'=>'',
            'ulasan'=>'',
        ]);
        $validated=$validator->validate();
        // $gambar = $validated['gambar'];
        // dump($gambar);
        echo "<script>cosole.log($request)</script>";
        
        if($validator->passes()){
            //gambar
            // $filename=$validated['gambar']->hashName();
            // $imagePath= $validated['gambar']->move('images/ulasan/', $filename);
            
            $ulasan = new Ulasans();
            $ulasan->id_user = $id_user;
            $ulasan->id_objek_wisata= $request->id_objek_wisata;
            $ulasan->ulasan = $request->ulasan;
            $ulasan->date = $request->date;
            // $ulasan->gambar= $imagePath;
            if($ulasan->save()){
                return response()->json(['success'=>'Berhasil menambahkan ulasan']);
            }else{

            }
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
