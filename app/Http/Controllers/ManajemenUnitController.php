<?php

namespace App\Http\Controllers;

use App\Unit;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class ManajemenUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unit.index');
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
        $storeunit = Unit::create([
            'nama_unit' => $request->nama,
            'kode_unit' => $request->kode
        ]);

        if ($storeunit) {
            return redirect()->back()->with('success', 'Data unit berhasil ditambahkan');
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

    public function get_data_unit()
    {
        $unit = Unit::select('units.*');
        $datatables = Datatables::of($unit);
        $datatables->orderColumn('kode_unit', function ($query, $order) {
            $query->orderBy('units.kode_unit', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','unit.action')
        ->toJson(); 
    }
}
