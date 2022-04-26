<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \stdClass;
use App\AktivitasSistem;
use App\DataRuangan;
use App\DataAset;
use App\Roles;
Use Validator;
Use Auth;
use App\Imports\DataRuanganImport;

class ManajemenRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataruangan = DataRuangan::all();
        return response()->json([
            'message' => 'Success',
            'data' => $dataruangan   
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $dataruangan = DataRuangan::find($id);

        if (!$dataruangan) {
            return response()->json([
                'message' => 'Ruangan tidak ditemukan', 
            ], 200);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $dataruangan   
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
            'kode_ruangan' => 'required|unique:data_ruangan,kode_ruangan',
            'nama_ruangan' => 'required',
            'nip' => 'required|numeric',
            'pj' => 'required',
            'kode_gedung' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $dataruangan = DataRuangan::create([
          'kode_ruangan' => $request->kode_ruangan,
          'nama_ruangan' => $request->nama_ruangan,
          'pj' => $request->pj,
          'nip' => $request->nip,
          'kode_gedung' => $request->kode_gedung,
        ]);

        if ($dataruangan) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan penambahan data ruangan',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);
            return response()->json([
                'message'=>'Berhasil menambahkan ruangan',
                'data' => $dataruangan
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
            'nama_ruangan' => 'required',
            'nip' => 'required|numeric',
            'pj' => 'required',
            'kode_gedung' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $currentKodeRuangan = DataRuangan::where('id', $id)->first();

        if (!$currentKodeRuangan) {
            return response()->json([
                'message' => 'Ruangan tidak ditemukan'
            ], 404);
        }

        $dataruangan = DataRuangan::where('id', $id)->update([
          'nama_ruangan' => $request->nama_ruangan,
          'pj' => $request->pj,
          'nip' => $request->nip,
          'kode_gedung' => $request->kode_gedung,
        ]);

        $dataaset = DataAset::where('kode_ruangan', $currentKodeRuangan->kode_ruangan)->get();
        // dd($dataaset);
        foreach ($dataaset as $key => $value) {
            $value->update([
                'kode_ruangan' => $request->kode_ruangan,
                'ruangan' => $request->nama_ruangan
            ]);
        }
        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan update data ruangan',
            'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
        ]);
        return response()->json([
            'message'=>'Berhasil melakukan update ruangan',
            'data' => DataRuangan::where('id', $id)->first()
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataruangan = DataRuangan::where('id', $id)->first();

        if (!$dataruangan) {
            return response()->json([
                'message' => 'Ruangan tidak ditemukan'
            ], 404);
        }

        $dataaset = DataAset::where('kode_ruangan', $dataruangan->kode_ruangan)->first();
        if ($dataaset == NULL) {
            if ($dataruangan) {
                $dataruangan->delete();
                $activity = AktivitasSistem::create([
                    'user_id' => Auth::user()->id,
                    'user_activity' => Auth::user()->name.' melakukan hapus data ruangan',
                    'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
                ]);
                return response()->json([
                    'message'=>'Berhasil melakukan hapus data ruangan',
                ], 201);
            }
        } else {
            return response()->json([
                'message'=>'Data ruangan gagal dihapus (Data ruangan sedang digunakan!)',
            ], 400);
        }
    }
}
