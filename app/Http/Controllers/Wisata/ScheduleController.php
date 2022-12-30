<?php

namespace App\Http\Controllers\Wisata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedules;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        if ($request->ajax()) {
            $data = Schedules::select('schedules.*','schedules.date as date', 'objek_wisatas.nama as nama_objek_wisata', 'gambar_objeks.gambar as gambar')
            ->join('objek_wisatas', 'objek_wisatas.id_objek_wisata', '=', 'schedules.id_objek_wisata')
            ->join('gambar_objeks', 'objek_wisatas.id_gambar', '=', 'gambar_objeks.id_gambar_objek')
            ->where('schedules.id_user', '=', $id_user)
                ->orderBy('schedules.date', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $data = [
                        $row->id_schedule,
                        $row->kode,
                    ];
                    return $data;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.wisatas.schedule');
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
        $id_user=Auth::user()->id;
        
        $validator = Validator::make($request->all(), [
            'jumlah_orang' => 'required',
            'id_objek_wisata' => 'required',
            'total_anggaran' => 'required',
            'date'=>'required|after:today'
        ]);

        if ($validator->passes()) {
            // $total_harga = $request->harga * $request->jumlah_orang;
            $pesanan          = new Schedules();
            $pesanan->jumlah_orang   = $request->jumlah_orang;
            $pesanan->total_anggaran = $request->total_anggaran;
            $pesanan->id_objek_wisata = $request->id_objek_wisata;
            $pesanan->id_user = $id_user;
            $pesanan->date=$request->date;
            $pesanan->kode=sprintf("%03d", $request->id_objek_wisata) . str_replace('-', '', $request->date  ) . sprintf("%03d", $id_user) . sprintf("%03d",$request->jumlah_orang);
            if ($pesanan->save()) {
                return response()->json(['success' => 'Berhasil Memesan tiket.']);   
            }else{
                return response()->json(['gagal' => 'Gagal Memesan tiket.']);   
            }
        }else{
            return response()->json(['error' => $validator->errors()->all()]);
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
        $kode=Schedules::where('id_schedule', $id)->first();
        return response()->json(['']);
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
