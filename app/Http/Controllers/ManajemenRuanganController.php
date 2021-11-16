<?php

namespace App\Http\Controllers;

use App\DataRuangan;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class ManajemenRuanganController extends Controller
{
  public function index(){
    return view('data-ruangan.index');
  }

  public function get_data_ruangan(){
    $dataruangan = DataRuangan::select('data_ruangan.*');
    $datatables = Datatables::of($dataruangan);
    $datatables->orderColumn('kode_ruangan', function ($query, $order) {
        $query->orderBy('data_ruangan.kode_ruangan', $order);
    });
    return $datatables->addIndexColumn()
    ->addColumn('action','data-aset.log-import.action')
    ->toJson();
  }

  public function store(Request $request){
    $validate = $request->validate([
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
      return redirect()->back()->with('success', 'Data ruangan berhasil ditambahkan');
    }
  }

  public function importexcel(Request $request){
    $file = $request->file('fileimport')->getRealPath();
    $import = new DataRuanganImport();
    $import->import($file);
  }
}
