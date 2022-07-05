<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\DataPengajuan;
use App\User;
use App\Unit;
use App\DataRuangan;
use App\Roles;
use Notification;
use App\DataInventaris;
use Auth;
use App\AktivitasSistem;
use App\DetailLogImportPengajuan;
use App\LogImportPengajuan;
use App\Imports\PengajuanDataInventarisImport;
use App\Notifications\PengajuanNotification;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengajuan-admin.index');
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
        $dataPengajuan = DataPengajuan::find($id);
        $dataPengajuan->delete();
        return redirect()->back()->with('success','Berhasil menghapus pengajuan inventaris');
    }

    public function get_data_pengajuan(Request $request)
    {
        $dataPengajuan = DataPengajuan::where('status_pengajuan','Belum Dikonfirmasi')->leftjoin('units', 'units.kode_unit', 'data_pengajuan.unit')
        ->select('data_pengajuan.*',  'units.nama_unit');
        $datatables = Datatables::of($dataPengajuan);
        if (isset($request->search['value'])) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('no_pengajuan', 'like', "%" . $keyword . "%");

        });}
        $datatables->orderColumn('updated_at', function ($query, $order) {
            $query->orderBy('data_pengajuan.updated_at', $order);
        });
        return $datatables->addIndexColumn()
        ->editColumn('status_pengajuan', function(DataPengajuan $datapengajuan) {
            if ($datapengajuan->status_pengajuan == 'Belum Dikonfirmasi') {
                return '<div style="background: rgb(203, 214, 255); border-radius: 2rem;" class="p-2 text-dark"><i class="far fa-clock me-2"></i>'.$datapengajuan->status_pengajuan.'</div>';
            }
            if ($datapengajuan->status_pengajuan == 'Disetujui') {
                return '<div style="background: rgb(197, 255, 205); border-radius: 2rem;" class="p-2 text-dark"><i class="fas fa-check-circle me-2"></i>'.$datapengajuan->status_pengajuan.'</div>';
            }
            if ($datapengajuan->status_pengajuan == 'Ditolak') {
                return '<div style="background: rgb(255, 185, 185); border-radius: 2rem;" class="p-2 text-dark"><i class="fas fa-check-circle me-2"></i>'.$datapengajuan->status_pengajuan.'</div>';
            }
        })
        ->escapeColumns([])
        ->addColumn('action','pengajuan-admin.button-datatable.action')
        ->toJson();
    }

    public function get_data_pengajuan_user(Request $request)
    {
        $dataPengajuan = DataPengajuan::where('id_pengaju', $request->id)->leftjoin('units', 'units.kode_unit', 'data_pengajuan.unit')
        ->select('data_pengajuan.*',  'units.nama_unit');

        if ($request->status_pengajuan != NULL) {
            $dataPengajuan = $dataPengajuan->where('status_pengajuan',$request->status_pengajuan);
        }

        $datatables = Datatables::of($dataPengajuan);
        if (isset($request->search['value'])) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('no_pengajuan', 'like', "%" . $keyword . "%");

        });}
        $datatables->orderColumn('updated_at', function ($query, $order) {
            $query->orderBy('data_pengajuan.updated_at', $order);
        });
        return $datatables->addIndexColumn()
        ->editColumn('status_pengajuan', function(DataPengajuan $datapengajuan) {
            if ($datapengajuan->status_pengajuan == 'Belum Dikonfirmasi') {
                return '<div style="background: rgb(203, 214, 255); border-radius: 2rem;" class="p-2 text-dark"><i class="far fa-clock me-2"></i>'.$datapengajuan->status_pengajuan.'</div>';
            }
            if ($datapengajuan->status_pengajuan == 'Disetujui') {
                return '<div style="background: rgb(197, 255, 205); border-radius: 2rem;" class="p-2 text-dark"><i class="fas fa-check-circle me-2"></i>'.$datapengajuan->status_pengajuan.'</div>';
            }
            if ($datapengajuan->status_pengajuan == 'Ditolak') {
                return '<div style="background: rgb(255, 185, 185); border-radius: 2rem;" class="p-2 text-dark"><i class="fas fa-check-circle me-2"></i>'.$datapengajuan->status_pengajuan.'</div>';
            }
        })
        ->escapeColumns([])
        ->addColumn('action','pengajuan-user.action')
        ->toJson();
    }

    public function list_pengajuan()
    {
        return view('pengajuan-user.list-pengajuan',['id_unit' => Auth::user()->id]);
    }

    public function confirm_request(Request $request, $no_pengajuan)
    {
    
        $datapengajuan = DataPengajuan::where('no_pengajuan', $no_pengajuan)->first();
        // dd($datapermintaan);
        if ($request->status == 'Disetujui') {
            $datapengajuan->update([
                'status_pengajuan' => $request->status,
                'catatan' => $request->catatan
            ]);

            $cekdata = DataInventaris::where('kode', $datapengajuan->kode_barang)->where('nup', $datapengajuan->nup)->get();
            if ($cekdata->count() == 0) {
              
              $datainventaris_save = DataInventaris::create([
                  'nama_barang' => $datapengajuan->nama_barang,
                  'kode' => $datapengajuan->kode,
                  'nup' => $datapengajuan->nup,
                  'uraian_barang' => $datapengajuan->uraian_barang,
                  'harga_satuan' => $datapengajuan->harga_satuan,
                  'harga_total' => $datapengajuan->harga_total,
                  'nilai_tagihan' => $datapengajuan->nilai_tagihan,
                  'tanggal_SP2D' => $datapengajuan->tanggal_SP2D,
                  'nomor_SP2D' => $datapengajuan->nomor_SP2D,
                  'kelompok_belanja' => $datapengajuan->kelompok_belanja,
                  'asal_perolehan' => $datapengajuan->asal_perolehan,
                  'nomor_bukti_perolehan' => $datapengajuan->nomor_bukti_perolehan,
                  'merk' => $datapengajuan->merk,
                  'sumber_dana' => $datapengajuan->sumber_dana,
                  'pic' => $datapengajuan->pic,
                  'kode_ruangan' => $datapengajuan->kode_ruangan,
                  'kondisi' => $datapengajuan->kondisi,
                  'unit' => $datapengajuan->unit,
                  'status' => 'Aktif',
                  'gedung' => $datapengajuan->gedung,
                  'foto' => $datapengajuan->foto,
                  'tahun_pengadaan' => $datapengajuan->tahun_pengadaan,
                  'ruangan' => $datapengajuan->ruangan,
                  'catatan' => $datapengajuan->catatan,
              ]);
              $activity = AktivitasSistem::create([
                  'user_id' => Auth::user()->id,
                  'user_activity' => Auth::user()->name.' melakukan menyetujui pengajuan inventaris',

                  'user_role' => Roles::find(Auth::user()->role_id)->name,
              ]);
            return redirect()->back()->with('success','Data Inventaris berhasil ditambahkan');
            } else {
                $message = 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup_awal.' telah terdaftar!';
                return redirect()->back()->with('error',$message);
            }
        } else {
            $datapengajuan->update([
                'status_pengajuan' => $request->status,
                'catatan' => $request->catatan
            ]);
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan penolakan pengajuan inventaris',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
        }


        $user = User::where('id', $datapengajuan->id_pengaju)->first();

        $details = [
            'body' => 'Permintaan peminjaman dengan no: '.$datapengajuan->no_pengajuan.' telah dikonfirmasi',
        ];

        Notification::send($user, new PengajuanNotification($details));

        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan konfirmasi permintaan peminjaman',

            'user_role' => Roles::find(Auth::user()->role_id)->name,
        ]);

        return redirect()->back()->with('success', 'Berhasil melakukan konfirmasi');
    }

    public function formpengajuan()
    {
        $kondisi = [
            'Baik' => 'Baik',
            'Rusak Ringan' => 'Rusak Ringan',
            'Rusak Berat' => 'Rusak Berat'
        ];
        $unit = Unit::all();
        $dataruangan = DataRuangan::all();
        return view('pengajuan-user.index',['unit' => $unit, 'kondisi' => $kondisi, 'dataruangan'=>$dataruangan]);
    }

    public function storepengajuan(Request $request)
    {
        $fotoinventaris = NULL;

        if ($request->foto != NULL) {
            $fileFotoInventaris = $request->foto;
            $fileName_fotoInventaris = time().'_'.$fileFotoInventaris->getClientOriginalName();
            $fileFotoInventaris->move(public_path('storage\foto-inventaris'), $fileName_fotoInventaris);

            $fotoinventaris = $fileName_fotoInventaris;
        }

        
        $validate = $request->validate([
            'kode_barang' => 'numeric',
            'jumlah_barang' => 'numeric',
            'nomor_sp2d' => 'numeric',
            'nup_awal' => 'numeric',
            'nup_akhir' => 'numeric'
        ]);
        

        function RemoveSpecialChar($str) {
            $res = str_replace( array( '.' ), '', $str);

            return $res;
        }

        $no_pengajuan = 1;
        $dataPengajuan = DataPengajuan::all();
        if ($dataPengajuan->count() != 0) {
            $no_pengajuan = $dataPengajuan->max('no_pengajuan')+1;
        }

        $harga_satuan = RemoveSpecialChar($request->harga_satuan);
        $harga_total = RemoveSpecialChar($request->harga_total);
        $nilai_tagihan = RemoveSpecialChar($request->nilai_tagihan);
        $date_sp2d = date('d-m-Y H:i:s', strtotime($request->tanggal_sp2d));

        $current_nup= $request->nup_awal;
        $nup_akhir = $request->nup_akhir;

        $cekdata = DataInventaris::where('kode', $request->kode_barang)->where('nup', $request->nup_awal)->get();
        $cekdata2 = DataPengajuan::where('kode', $request->kode_barang)->where('nup', $current_nup)->get();
        if ($cekdata->count() == 0 AND $cekdata2->count() == 0 ) {
            $dataPengajuanSave = DataPengajuan::create([
                'id_pengaju' => Auth::user()->id,
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
                'status_pengajuan' => 'Belum Dikonfirmasi',
                'no_pengajuan' => $no_pengajuan,
            ]);

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan penambahan inventaris',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
            $user = User::where('role_id', '3')->get();
            $details = [
                'body' => 'Permintaan pengajuan dengan no pengajuan: '.$dataPengajuanSave->no_pengajuan.' menunggu konfirmasi'
            ];
            foreach ($user as $key => $value) {
                Notification::send($value, new PengajuanNotification($details));
            }
            return redirect(route('pengajuan.form'))->with('success','Data Inventaris berhasil diajukan');
        } else {
            $message = 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup_awal.' telah terdaftar atau telah diajukan!';
            return redirect(route('pengajuan.form'))->with('error',$message);
        }

    
    }

    public function get_ruangan(Request $request)
    {
        $ruangan = DataRuangan::where('kode_ruangan', $request->kode)->first();

        return response()->json([
            'data' => $ruangan->nama_ruangan,
        ]);
    }

    public function import_index()
    {
        return view('pengajuan-user.import');
    }

    public function import_template(){
        $filepath = public_path('template-import-data-inventaris/Template-Data-Inventaris.xlsx');
        return response()->download($filepath);
    }

    public function import_data(Request $request){

        $request->validate([
            'fileimport' => 'required',
        ],[
            'fileimport.required' => 'Masukkan file impor!'
        ]);

        $importsdata = LogImportPengajuan::create([
            'user_id' => Auth::user()->id,
            'total' => '',
            'success' => '',
            'failed' => ''
        ]);

        $importId = $importsdata->id;

        $file = $request->file('fileimport')->getRealPath();
        $import = new PengajuanDataInventarisImport($importId);
        $import->import($file);

        $currentrow= 0;
        $freewalk=0;

        if ($import->failures()->isNotEmpty()) {
            foreach ($import->failures() as $rows) {
                // dd($rows->values()["no"]);
                $failed = DetailLogImportPengajuan::create([
                    'row' => $rows->values()["no"],
                    'nama' => $rows->values()["nama_barang"],
                    'status' => 'Failed',
                    'message' => $rows->errors()[0],
                    'import_id' => $importId
                ]);
            }
        }

        $total = DetailLogImportPengajuan::where('import_id', $importId)->get()->count();
        $success = DetailLogImportPengajuan::where('import_id', $importId)->where('status', 'Success')->get()->count();
        $failed = DetailLogImportPengajuan::where('import_id', $importId)->where('status', 'Failed')->get()->count();

        $importsdata = LogImportPengajuan::where('id', $importId)->update([
            'total' => $total,
            'success' => $success,
            'failed' => $failed,
        ]);

        if ($importsdata != NULL) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan impor pengajuan data inventaris',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
            return redirect()->back()->with('success', 'Berhasil melakukan impor');
        }

    }

    public function getdataimport(Request $request){
        $logimport = LogImportPengajuan::where('user_id', Auth::user()->id)->select('log_import_pengajuan.*');
        $datatables = Datatables::of($logimport);
        $datatables->orderColumn('created_at', function ($query, $order) {
            $query->orderBy('log_import_pengajuan.created_at', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','pengajuan-user.log-import.action')
        ->toJson();
    }

    public function detail_riwayat_import($id){
        $import_id = $id;
        return view('pengajuan-user.detail-log-import', compact('import_id'));
    }

    public function destroy_log_import(Request $request,$id)
    {
        $riwayat = LogImportPengajuan::where('id', $id)->first();
        $detailriwayat = DetailLogImportPengajuan::where('import_id', $riwayat->id)->get();

        foreach ($detailriwayat as $key => $value) {
            $value->delete();
        }
        $riwayat = $riwayat->delete();
        if ($riwayat) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan hapus riwayat impor',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
            return redirect()->back()->with('success','Riwayat impor berhasil dihapus');
        }
    }

    public function getdatadetailimport(Request $request){
        $logdetailimport = DetailLogImportPengajuan::where('import_id', $request->id)->get();
        $datatables = Datatables::of($logdetailimport);

        return $datatables->addIndexColumn()
        ->toJson();
    }
}
