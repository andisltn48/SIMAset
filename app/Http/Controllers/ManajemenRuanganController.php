<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \stdClass;
use App\DataRuangan;
use App\AktivitasSistem;
use App\DataAset;
use Auth;
use Yajra\Datatables\Datatables;
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
        return view('data-ruangan.index');
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
        $validate = $request->validate([
            'kode_ruangan' => 'unique:data_ruangan,kode_ruangan',
            'nip' => 'numeric',
            'kode_gedung' => 'numeric',
        ]);

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

                'user_role' => session('role'),
            ]);
            return redirect()->back()->with('success', 'Data ruangan berhasil ditambahkan');
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
        // dd($id);
        $validate = $request->validate([
            'nip' => 'numeric',
            'kode_gedung' => 'numeric',
        ]);
        $currentKodeRuangan = DataRuangan::where('id', $id)->first();

        $dataruangan = DataRuangan::where('id', $id)->update([
          'kode_ruangan' => $request->kode_ruangan,
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

            'user_role' => session('role'),
        ]);
        return redirect()->back()->with('success', 'Data ruangan berhasil diedit');

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
        $dataaset = DataAset::where('kode_ruangan', $dataruangan->kode_ruangan)->first();
        if ($dataaset == NULL) {
            if ($dataruangan) {
                $dataruangan->delete();
                $activity = AktivitasSistem::create([
                    'user_id' => Auth::user()->id,
                    'user_activity' => Auth::user()->name.' melakukan hapus data ruangan',

                    'user_role' => session('role'),
                ]);
                return redirect()->back()->with('success', 'Data ruangan berhasil dihapus');
            }
        } else {

            return redirect()->back()->with('error', 'Data ruangan gagal dihapus (Data ruangan sedang digunakan!)');
        }

    }

    public function get_data_ruangan(Request $request){
        $dataruangan = DataRuangan::select('data_ruangan.*');
        $datatables = Datatables::of($dataruangan);
        if ($request->get('search')['value']) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('kode_ruangan', 'like', "%" . $keyword . "%");

        });}
        $datatables->orderColumn('kode_ruangan', function ($query, $order) {
            $query->orderBy('data_ruangan.kode_ruangan', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','data-ruangan.action')
        ->toJson();
    }

    public function importexcel(Request $request){
        $file = $request->file('fileimport')->getRealPath();
        $import = new DataRuanganImport();
        $import->import($file);
        $main_array = [];
        $message = '';
        if ($import->failures()->isNotEmpty()) {
            foreach ($import->failures() as $rows) {
              $seccond_array = [
                'kode' => $rows->values()["kode"],
                'nama' => $rows->values()["nama_ruang"],
                'message' => $rows->errors()[0]
              ];

              $main_arrays[] = $seccond_array;
            //   array_push($main_arrays, $seccond_array);
              // var_dump($rows->values()["kode"]);
            }
        } else {
            $main_arrays = NULL;
        }

        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan impor data ruangan',

            'user_role' => session('role'),
        ]);
    // $myJSON = json_encode($json_failed);
        if ($main_arrays != NULL) {
            return redirect()->back()->with('error',$main_arrays);
        } else {
            return redirect()->back()->with('success', 'berhasil melakukan import data ruangan');
        }

    }
}
