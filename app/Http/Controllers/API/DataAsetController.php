<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataAset;
use App\Unit;
use App\DataRuangan;
use App\LogImport;
use App\DetailLogImport;
use Yajra\Datatables\Datatables;
use App\Exports\DataAsetExport;
use App\Imports\DataAsetImport;
use Maatwebsite\Excel\Facades\Excel;

class DataAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataaset = DataAset::leftjoin('units', 'units.kode_unit', 'data_aset.unit')
        ->select('data_aset.*',  'units.nama_unit')->get();

        return response()->json([
            'message' => 'Success',
            'data' => $dataaset   
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {

        $dataaset = DataAset::where('data_aset.id', $id)->leftjoin('units', 'units.kode_unit', 'data_aset.unit')
        ->select('data_aset.*',  'units.nama_unit')->first();

        return response()->json([
            'message' => 'Success',
            'data' => $dataaset   
        ], 200);
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
}
