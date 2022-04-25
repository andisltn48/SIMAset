<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use App\AktivitasSistem;
use App\DataAset;
use App\Roles;
Use Validator;
Use Auth;

class ManajemenUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Unit::all();
        return response()->json([
            'message' => 'Success',
            'data' => $unit   
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'message' => 'Unit tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $unit   
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
        $validator = Validator::make($request->all(), [
            'kode_unit' => 'required|unique:units,kode_unit',
            'nama_unit' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $storeunit = Unit::create([
            'nama_unit' => $request->nama_unit,
            'kode_unit' => $request->kode_unit
        ]);



        if ($storeunit) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan tambah data unit',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);

            return response()->json([
                'message' => 'Data unit berhasil ditambahkan',
                'data' => $storeunit
            ], 201);
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
        $validator = Validator::make($request->all(), [
            'nama_unit' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'message' => 'Unit tidak ditemukan',
            ], 404);
        }

        if ($unit) {
            $unit->update([
                'nama_unit' => $request->nama_unit,
            ]);

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan update data unit',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);

            // return redirect()->back()->with('success', 'Data unit berhasil diupdate');
            return response()->json([
                'message' => 'Data unit berhasil diupdate',
                'data' => Unit::find($id)
            ], 201);
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

        // dd($unit);

        if (!$unit) {
            return response()->json([
                'message' => 'Unit tidak ditemukan',
            ], 404);
        }

        $dataAset = DataAset::where('unit',$unit->kode_unit)->first();
        if (!$dataAset) {
            $unit->delete();

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan hapus data unit',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);

            return response()->json([
                'message' => 'Data unit berhasil dihapus',
            ], 201);
        } else {
            // return redirect()->back()->with('error', 'Data unit sedang digunakan');
            return response()->json([
                'message' => 'Data unit sedang digunakan',
            ], 400);
        }
    }
}
