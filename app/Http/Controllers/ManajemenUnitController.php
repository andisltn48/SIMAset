<?php

namespace App\Http\Controllers;

use App\Unit;
use App\DataAset;
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
        $request->validate([
            'kode' => 'unique:units,kode_unit'
        ]);
        $storeunit = Unit::create([
            'nama_unit' => $request->nama,
            'kode_unit' => $request->kode
        ]);

        if ($storeunit) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan tambah data unit',

                'user_role' => session('role'),
            ]);
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
        $unit = Unit::find($id);
        if ($unit) {
            $unit->update([
                'nama_unit' => $request->nama,
            ]);

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan update data unit',

                'user_role' => session('role'),
            ]);

            return redirect()->back()->with('success', 'Data unit berhasil diupdate');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $dataAset = DataAset::where('unit',$unit->kode_unit)->first();
        if (!$dataAset) {
            $unit->delete();

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan hapus data unit',

                'user_role' => session('role'),
            ]);
            return redirect()->back()->with('success', 'Data unit berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data unit sedang digunakan');
        }
    }

    public function get_data_unit(Request $request)
    {
        $unit = Unit::select('units.*');
        $datatables = Datatables::of($unit);
        if ($request->get('search')['value']) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('kode_unit', 'like', "%" . $keyword . "%");

        });}
        $datatables->orderColumn('kode_unit', function ($query, $order) {
            $query->orderBy('units.kode_unit', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','unit.action')
        ->toJson();
    }
}
