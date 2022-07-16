<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataInventaris;
use App\Unit;
use App\DataRuangan;
use App\LogImport;
use App\Roles;
use App\DetailLogImport;
use App\AktivitasSistem;
use Yajra\Datatables\Datatables;
use App\Exports\DataInventarisExport;
use App\Imports\DataInventarisImport;
use Maatwebsite\Excel\Facades\Excel;
Use Validator;
Use Auth;

class DataInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datainventaris = DataInventaris::leftjoin('units', 'units.kode_unit', 'data_inventaris.unit')
        ->select('data_inventaris.*',  'units.nama_unit')->get();

        return response()->json([
            'message' => 'Success',
            'data' => $datainventaris   
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {

        $datainventaris = DataInventaris::where('data_inventaris.id', $id)->leftjoin('units', 'units.kode_unit', 'data_inventaris.unit')
        ->select('data_inventaris.*',  'units.nama_unit')->first();

        if ($datainventaris) {
            return response()->json([
                'message' => 'Success',
                'data' => $datainventaris   
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data inventaris tidak ditemukan',   
            ], 404);
        }
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
            'nama_barang' => 'required',
            'kode_barang' => 'required|numeric',
            'jumlah_barang' => 'required|numeric',
            'nomor_sp2d' => 'required|numeric',
            'nup_awal' => 'required|numeric',
            'uraian_barang' => 'required',
            'harga_satuan' => 'required',
            'harga_total' => 'required',
            'nilai_tagihan' => 'required',
            'tanggal_SP2D' => 'required',
            'nomor_SP2D' => 'required',
            'kelompok_belanja' => 'required',
            'asal_perolehan' => 'required',
            'nomor_bukti_perolehan' => 'required',
            'merk' => 'required',
            'sumber_dana' => 'required',
            'pic' => 'required',
            'kode_ruangan' => 'required',
            'kondisi' => 'required',
            'unit' => 'required',
            'status' => 'Aktif',
            'tahun_pengadaan' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $fotoinventaris = NULL;

        if ($request->foto != NULL) {
            $fileFotoInventaris = $request->foto;
            $fileName_fotoInventaris = time().'_'.$fileFotoInventaris->getClientOriginalName();
            $fileFotoInventaris->move(public_path('storage/foto-inventaris'), $fileName_fotoInventaris);

            $fotoinventaris = $fileName_fotoInventaris;
        }

        // dd($request);
        if ($request->nup_akhir != NULL)  {
            $validator = Validator::make($request->all(), [
                'nup_akhir' => 'required',
            ]);

            if ($validator2->fails()) {
                return response()->json($validator->messages(), 400);
            } 
        }

        function RemoveSpecialChar($str) {
            $res = str_replace( array( '.' ), '', $str);

            return $res;
        }

        $harga_satuan = RemoveSpecialChar($request->harga_satuan);
        $harga_total = RemoveSpecialChar($request->harga_total);
        $nilai_tagihan = RemoveSpecialChar($request->nilai_tagihan);
        $date_sp2d = date('d-m-Y H:i:s', strtotime($request->tanggal_sp2d));

        $current_nup= $request->nup_awal;
        $nup_akhir = $request->nup_akhir;

        if ($request->jumlah_barang > 1) {
            for ($current_nup; $current_nup <= $nup_akhir ; $current_nup++) {
                $cekdata = DataInventaris::where('kode', $request->kode_barang)->where('nup', $current_nup)->get();
                if ($cekdata->count() == 0) {
                // echo 'halo';
                $datainventaris_save = DataInventaris::create([
                    'nama_barang' => $request->nama_barang,
                    'kode' => $request->kode_barang,
                    'nup' => $current_nup,
                    'uraian_barang' => $request->uraian_barang,
                    'harga_satuan' => $harga_satuan,
                    'harga_total' => $harga_total,
                    'nilai_tagihan' => $nilai_tagihan,
                    'tanggal_SP2D' => $date_sp2d,
                    'nomor_SP2D' => $request->nomor_sp2d,
                    'kelompok_belanja' => $request->kelompok_belanja,
                    'asal_perolehan' => $request->asal_perolehan,
                    'nomor_bukti_perolehan' => $request->nomor_bukti_perolehan,
                    'merk' => $request->merk,
                    'sumber_dana' => $request->sumber_dana,
                    'pic' => $request->pic,
                    'kode_ruangan' => $request->kode_ruangan,
                    'kondisi' => $request->kondisi,
                    'unit' => $request->unit,
                    'status' => 'Aktif',
                    'gedung' => $request->gedung,
                    'tahun_pengadaan' => $request->tahun_pengadaan,
                    'ruangan' => $request->ruangan,
                    'foto' => $fotoinventaris,
                    'catatan' => $request->catatan,
                ]);
                } else {
                    return response()->json([
                        'message' => 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$current_nup.' telah terdaftar!',
                    ], 400);
                    // return redirect(route('data-inventaris.create'))->with('error','Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$current_nup.' telah terdaftar!');
                }

            }

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan penambahan inventaris',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);

            return response()->json([
                'message'=>'Berhasil menambahkan inventaris',
                'data' => $datainventaris_save
            ], 201);
            // return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil ditambahkan');
        } else {
            $cekdata = DataInventaris::where('kode', $request->kode_barang)->where('nup', $request->nup_awal)->get();
            if ($cekdata->count() == 0) {
              $fotoinventaris = NULL;

              if ($request->foto != NULL) {
                  $fileFotoInventaris = $request->foto;
                  $fileName_fotoInventaris = time().'_'.$fileFotoInventaris->getClientOriginalName();
                  $fileFotoInventaris->move(public_path('storage/foto-inventaris'), $fileName_fotoInventaris);

                  $fotoinventaris = $fileName_fotoInventaris;
              }
              $datainventaris_save = DataInventaris::create([
                  'nama_barang' => $request->nama_barang,
                  'kode' => $request->kode_barang,
                  'nup' => $request->nup_awal,
                  'uraian_barang' => $request->uraian_barang,
                  'harga_satuan' => $harga_satuan,
                  'harga_total' => $harga_total,
                  'nilai_tagihan' => $nilai_tagihan,
                  'tanggal_SP2D' => $date_sp2d,
                  'nomor_SP2D' => $request->nomor_sp2d,
                  'kelompok_belanja' => $request->kelompok_belanja,
                  'asal_perolehan' => $request->asal_perolehan,
                  'nomor_bukti_perolehan' => $request->nomor_bukti_perolehan,
                  'merk' => $request->merk,
                  'sumber_dana' => $request->sumber_dana,
                  'pic' => $request->pic,
                  'kode_ruangan' => $request->kode_ruangan,
                  'kondisi' => $request->kondisi,
                  'unit' => $request->unit,
                  'status' => 'Aktif',
                  'gedung' => $request->gedung,
                  'foto' => $fotoinventaris,
                  'tahun_pengadaan' => $request->tahun_pengadaan,
                  'ruangan' => $request->ruangan,
                  'catatan' => $request->catatan,
              ]);
              $activity = AktivitasSistem::create([
                  'user_id' => Auth::user()->id,
                  'user_activity' => Auth::user()->name.' melakukan penambahan inventaris',
                  'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
              ]);
              return response()->json([
                'message'=>'Berhasil menambahkan inventaris',
                'data' => $datainventaris_save
              ], 201);
            // return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil ditambahkan');
            } else {
                $message = 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup_awal.' telah terdaftar!';
                // return redirect(route('data-inventaris.create'))->with('error',$message);
                return response()->json([
                    'message'=>$message,
                ], 400);
            }

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
        // echo $id;
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kode_barang' => 'required|numeric',
            'nomor_sp2d' => 'required|numeric',
            'nup' => 'required|numeric',
            'uraian_barang' => 'required',
            'harga_satuan' => 'required',
            'harga_total' => 'required',
            'nilai_tagihan' => 'required',
            'tanggal_sp2d' => 'required',
            'kelompok_belanja' => 'required',
            'asal_perolehan' => 'required',
            'nomor_bukti_perolehan' => 'required',
            'merk' => 'required',
            'sumber_dana' => 'required',
            'pic' => 'required',
            'kode_ruangan' => 'required',
            'kondisi' => 'required',
            'unit' => 'required',
            'status' => 'Aktif',
            'tahun_pengadaan' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $current_data = DataInventaris::where('id', $id)->first();
        $cekdata = DataInventaris::where('kode', $request->kode_barang)->where('nup', $request->nup)->first();

        $fotoinventaris = NULL;

        if ($request->foto != NULL) {
            $fileFotoInventaris = $request->foto;
            $fileName_fotoInventaris = time().'_'.$fileFotoInventaris->getClientOriginalName();
            $fileFotoInventaris->move(public_path('storage/foto-inventaris'), $fileName_fotoInventaris);

            $fotoinventaris = $fileName_fotoInventaris;
        }

        if ($cekdata == NULL) {
            function RemoveSpecialChar($str) {
                $res = str_replace( array( '.' ), '', $str);

                return $res;
            }

            $harga_satuan = RemoveSpecialChar($request->harga_satuan);
            $harga_total = RemoveSpecialChar($request->harga_total);
            $nilai_tagihan = RemoveSpecialChar($request->nilai_tagihan);
            $date_sp2d = date('d-m-Y H:i:s', strtotime($request->tanggal_sp2d));

            $datainventaris_save = DataInventaris::where('id',$id)->update([
                'nama_barang' => $request->nama_barang,
                'kode' => $request->kode_barang,
                'nup' => $request->nup,
                'uraian_barang' => $request->uraian_barang,
                'harga_satuan' => $harga_satuan,
                'harga_total' => $harga_total,
                'nilai_tagihan' => $nilai_tagihan,
                'tanggal_SP2D' => $date_sp2d,
                'nomor_SP2D' => $request->nomor_sp2d,
                'kelompok_belanja' => $request->kelompok_belanja,
                'asal_perolehan' => $request->asal_perolehan,
                'nomor_bukti_perolehan' => $request->nomor_bukti_perolehan,
                'merk' => $request->merk,
                'sumber_dana' => $request->sumber_dana,
                'pic' => $request->pic,
                'kode_ruangan' => $request->kode_ruangan,
                'kondisi' => $request->kondisi,
                'unit' => $request->unit,
                'gedung' => $request->gedung,
                'foto' => $fotoinventaris,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'ruangan' => $request->ruangan,
                'catatan' => $request->catatan,
            ]);
            if ($datainventaris_save) {
                $activity = AktivitasSistem::create([
                    'user_id' => Auth::user()->id,
                    'user_activity' => Auth::user()->name.' melakukan update data inventaris',
                    'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
                ]);
                return response()->json([
                    'message'=>'Data Inventaris berhasil diedit',
                    'data' => DataInventaris::find($id)
                ], 201);
            }
        } elseif ($cekdata->kode == $current_data->kode && $cekdata->nup == $current_data->nup) {
            function RemoveSpecialChar($str) {
                $res = str_replace( array( '.' ), '', $str);

                return $res;
            }

            $harga_satuan = RemoveSpecialChar($request->harga_satuan);
            $harga_total = RemoveSpecialChar($request->harga_total);
            $nilai_tagihan = RemoveSpecialChar($request->nilai_tagihan);
            $date_sp2d = date('d-m-Y H:i:s', strtotime($request->tanggal_sp2d));

            $datainventaris_save = DataInventaris::where('id',$id)->update([
                'nama_barang' => $request->nama_barang,
                'kode' => $request->kode_barang,
                'nup' => $request->nup,
                'uraian_barang' => $request->uraian_barang,
                'harga_satuan' => $harga_satuan,
                'harga_total' => $harga_total,
                'nilai_tagihan' => $nilai_tagihan,
                'tanggal_SP2D' => $date_sp2d,
                'nomor_SP2D' => $request->nomor_sp2d,
                'kelompok_belanja' => $request->kelompok_belanja,
                'asal_perolehan' => $request->asal_perolehan,
                'nomor_bukti_perolehan' => $request->nomor_bukti_perolehan,
                'merk' => $request->merk,
                'sumber_dana' => $request->sumber_dana,
                'pic' => $request->pic,
                'kode_ruangan' => $request->kode_ruangan,
                'kondisi' => $request->kondisi,
                'unit' => $request->unit,
                'gedung' => $request->gedung,
                'foto' => $fotoinventaris,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'ruangan' => $request->ruangan,
                'catatan' => $request->catatan,
            ]);

            if ($datainventaris_save) {
                $activity = AktivitasSistem::create([
                    'user_id' => Auth::user()->id,
                    'user_activity' => Auth::user()->name.' melakukan update data inventaris',
                    'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
                ]);
                return response()->json([
                    'message'=>'Data Inventaris berhasil diedit',
                    'data' => DataInventaris::find($id)
                ], 201);
            }
        } else {
            $message = 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup.' telah terdaftar!';
            return response()->json([
                'message'=>$message
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $datainventaris = DataInventaris::where('id', $id)->delete();
        if ($datainventaris) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan hapus data inventaris',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);
            return response()->json([
                'message'=>'Data inventaris berhasil dihapus'
            ], 201);
        } else {
            return response()->json([
                'message'=>'Data inventaris tidak ditemukan'
            ], 404);
        }
    }

    public function import_data(Request $request){

        $validator = Validator::make($request->all(), [
            'file_import' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $importsdata = LogImport::create([
            'total' => '',
            'success' => '',
            'failed' => ''
        ]);

        // dd()

        $importId = $importsdata->id;

        $file = $request->file('file_import')->getRealPath();
        $import = new DataInventarisImport($importId);
        $import->import($file);

        $currentrow= 0;
        $freewalk=0;

        if ($import->failures()->isNotEmpty()) {
            foreach ($import->failures() as $rows) {
                // dd($rows->values()["no"]);
                $failed = DetailLogImport::create([
                    'row' => $rows->values()["no"],
                    'nama' => $rows->values()["nama_barang"],
                    'status' => 'Failed',
                    'message' => $rows->errors()[0],
                    'import_id' => $importId
                ]);
            }
        }

        $total = DetailLogImport::where('import_id', $importId)->get()->count();
        $success = DetailLogImport::where('import_id', $importId)->where('status', 'Success')->get()->count();
        $failed = DetailLogImport::where('import_id', $importId)->where('status', 'Failed')->get()->count();

        $importsdata = LogImport::where('id', $importId)->update([
            'total' => $total,
            'success' => $success,
            'failed' => $failed,
        ]);

        if ($importsdata != NULL) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan impor data inventaris',
                'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
            ]);
            // return redirect(route('data-inventaris.import'))->with('success', 'Berhasil melakukan impor');
            return response()->json([
                'message'=>'Berhasil melakukan impor'
            ], 201);
        }

    }
}
