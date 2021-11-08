<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataPeminjaman;
use App\DataAset;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function formpeminjaman(){
        return view('peminjaman-user/index');
    }

    public function storepermintaan(Request $request)
    {
        $validate = $request->validate([
            'surat_peminjaman' => 'required',
            'datadiri_penanggungjawab' => 'required',
        ]);


        var_dump(\Session::get('tempo-data'));
        if (\Session::get('tempo-data') != NULL) {
            $aset_selected = \Session::get('tempo-data');
            foreach ($aset_selected as $key => $value) {
                echo $value;
            }
            \Session::flush();
        } else {
            $validate = $request->validate([
                'sarana' => 'required'
            ]);
        }
        
    }

    public function templatesurat(){
        return view('peminjaman-user/template-surat');
    }

    public function get_free_aset(Request $request)
    {
        // echo "$request->tanggal_penggunaan";
        $kode_barang = DataPeminjaman::where('tanggal_penggunaan', $request->tanggal_penggunaan)->pluck('kode_barang')->all();
        $nup_barang = DataPeminjaman::where('tanggal_penggunaan', $request->tanggal_penggunaan)->pluck('nup_barang')->all();
        $dataaset1 = DataAset::whereNotIn('kode', $kode_barang)->get();
        $dataaset2 = DataAset::where('kode', $kode_barang)->whereNotIn('nup', $nup_barang)->get();
        $fixdata = $dataaset1->merge($dataaset2); 
        return response()->json([
            'data' => $fixdata,
        ]);
    }

    public function temporary_data(Request $request){
        $dataaset = DataAset::where('id', $request->curr_id)->first();
        // $arrayBaru = $re
        $items = collect($request->items);
        \Session::put('tempo-data', $items);
        return response()->json([
            // 'data' => \Session::get('tempo-data'),
            'data2' => $dataaset

        ]);
    }
}
