<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataInventaris;
use App\Unit;
use App\DataRuangan;
use App\Roles;
use App\LogImport;
use App\AktivitasSistem;
use App\DetailLogImport;
use Auth;
use Yajra\Datatables\Datatables;
use App\Exports\DataInventarisExport;
use App\Imports\DataInventarisImport;
use Maatwebsite\Excel\Facades\Excel;

class DataInventarisController extends Controller
{
    public function RemoveSpecialChar($str) {
        $res = str_replace( array( '.' ), '', $str);

        return $res;
    }

    public function index()
    {
        function convert($harga)
        {
            return strrev(implode('.', str_split(strrev(strval($harga)), 3)));
        };


        $dataruangan = DataRuangan::all();
        $datainventaris = DataInventaris::all();
        $hargatotal = 0;
        foreach ($datainventaris as $key => $value) {
            $hargatotal = $hargatotal + $this->RemoveSpecialChar($value['harga_satuan']);
        }

        $hargatotal = 'Rp ' . convert($hargatotal);

        $jumlahinventaris = DataInventaris::all()->count();
        $baik = DataInventaris::where('kondisi', 'Baik')->count();
        $rusakringan = DataInventaris::where('kondisi', 'Rusak Ringan')->count();
        $rusakberat = DataInventaris::where('kondisi', 'Rusak Berat')->count();
        $unit = Unit::all();
        return view('data-inventaris.index', ['unit'=>$unit, 'dataruangan'=>$dataruangan], compact('hargatotal', 'jumlahinventaris', 'baik', 'rusakringan', 'rusakberat'));
    }

    public function create()
    {
        $kondisi = [
            'Baik' => 'Baik',
            'Rusak Ringan' => 'Rusak Ringan',
            'Rusak Berat' => 'Rusak Berat'
        ];
        $unit = Unit::all();
        $dataruangan = DataRuangan::all();
        return view('data-inventaris/tambah',['unit' => $unit, 'kondisi' => $kondisi, 'dataruangan'=>$dataruangan]);
    }

    public function store(Request $request)
    {

        $fotoinventaris = NULL;

        if ($request->foto != NULL) {
            $fileFotoInventaris = $request->foto;
            $fileName_fotoInventaris = time().'_'.$fileFotoInventaris->getClientOriginalName();
            $fileFotoInventaris->move(public_path('storage\foto-inventaris'), $fileName_fotoInventaris);

            $fotoinventaris = $fileName_fotoInventaris;
        }

        // dd($request);
        if ($request->nup_akhir == NULL) {

            $validate = $request->validate([
                'kode_barang' => 'numeric',
                'jumlah_barang' => 'numeric',
                'nomor_sp2d' => 'numeric',
                'nup_awal' => 'numeric',
            ]);
        } else {
            $validate = $request->validate([
                'kode_barang' => 'numeric',
                'jumlah_barang' => 'numeric',
                'nomor_sp2d' => 'numeric',
                'nup_awal' => 'numeric',
                'nup_akhir' => 'numeric'
            ]);
        }


        $harga_satuan = $this->RemoveSpecialChar($request->harga_satuan);
        $harga_total = $this->RemoveSpecialChar($request->harga_total);
        $nilai_tagihan = $this->RemoveSpecialChar($request->nilai_tagihan);
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
                    return redirect(route('data-inventaris.create'))->with('error','Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$current_nup.' telah terdaftar!');
                }

            }

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan penambahan inventaris',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);

            return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil ditambahkan');
        } else {
            $cekdata = DataInventaris::where('kode', $request->kode_barang)->where('nup', $request->nup_awal)->get();
            if ($cekdata->count() == 0) {
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

                  'user_role' => Roles::find(Auth::user()->role_id)->name,
              ]);
            return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil ditambahkan');
            } else {
                $message = 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup_awal.' telah terdaftar!';
                return redirect(route('data-inventaris.create'))->with('error',$message);
            }

        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $dataruangan = DataRuangan::all();
        // echo ($id);
        $datainventaris = DataInventaris::where('id',$id)->first();
        $kondisi = [
            'Baik' => 'Baik',
            'Rusak Ringan' => 'Rusak Ringan',
            'Rusak Berat' => 'Rusak Berat'
        ];

        $unit = Unit::all();
        return view('data-inventaris.edit', compact('datainventaris'), ['kondisi' => $kondisi, 'unit'=>$unit, 'dataruangan'=>$dataruangan]);
        // var_dump($datainventaris);
    }

    public function update(Request $request, $id)
    {
        // echo $id;
        $validate = $request->validate([
            'kode_barang' => 'numeric',
            'jumlah_barang' => 'numeric',
            'nomor_sp2d' => 'numeric',
            'nup' => 'numeric'
        ]);

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

            $harga_satuan = $this->RemoveSpecialChar($request->harga_satuan);
            $harga_total = $this->RemoveSpecialChar($request->harga_total);
            $nilai_tagihan = $this->RemoveSpecialChar($request->nilai_tagihan);
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

                    'user_role' => Roles::find(Auth::user()->role_id)->name,
                ]);
                return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil diedit');
            }
        } elseif ($cekdata->kode == $current_data->kode && $cekdata->nup == $current_data->nup) {

            $harga_satuan = $this->RemoveSpecialChar($request->harga_satuan);
            $harga_total = $this->RemoveSpecialChar($request->harga_total);
            $nilai_tagihan = $this->RemoveSpecialChar($request->nilai_tagihan);
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

                    'user_role' => Roles::find(Auth::user()->role_id)->name,
                ]);
                return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil diedit');
            }
        } else {
            $message = 'Data Inventaris dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup.' telah terdaftar!';
            return redirect(route('data-inventaris.edit', $id))->with('error',$message);
        }
    }

    public function destroy(Request $request,$id)
    {
        $datainventaris = DataInventaris::where('id', $id)->delete();
        if ($datainventaris) {
            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan hapus data inventaris',

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);
            return redirect(route('data-inventaris.index'))->with('success','Data Inventaris berhasil dihapus');
        }
    }

    public function destroy_log_import(Request $request,$id)
    {
        $riwayat = LogImport::where('id', $id)->first();
        $detailriwayat = DetailLogImport::where('import_id', $riwayat->id)->get();

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
            return redirect(route('data-inventaris.import'))->with('success','Riwayat impor berhasil dihapus');
        }
    }

    public function import(){
        return view('data-inventaris.import');
    }

    public function detail_riwayat_import($id){
        $import_id = $id;
        return view('data-inventaris.detail-log-import', compact('import_id'));
    }

    public function getdatatable(Request $request){

        $datainventaris = DataInventaris::leftjoin('units', 'units.kode_unit', 'data_inventaris.unit')
            ->select('data_inventaris.*',  'units.nama_unit');

        if (isset($request->unit)) {
            $datainventaris = $datainventaris->where('units.kode_unit', $request->unit);
        }
        if (isset($request->kondisi)) {
            $datainventaris = $datainventaris->where('kondisi', $request->kondisi);
        }
        if (isset($request->koderuangan)) {
            // echo($request->koderuangan);
            $datainventaris = $datainventaris->where('kode_ruangan', $request->koderuangan);
        }
        if (isset($request->tahunpengadaan)) {
            $datainventaris = $datainventaris->where('tahun_pengadaan', $request->tahunpengadaan);
        }
        if (isset($request->kodebarang)) {
            $datainventaris = $datainventaris->where('kode', $request->kodebarang);
        }
        if (isset($request->nup)) {
            $datainventaris = $datainventaris->where('nup', $request->nup);
        }
        // if ($request->input('status') != null) {
        //     $datainventaris = $datainventaris->where('status', $request->status);
        // }
        $datatables = Datatables::of($datainventaris);

        if (isset($request->search['value'])) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('nama_barang', 'like', "%" . $keyword . "%");

        });}
        $datatables->orderColumn('updated_at', function ($query, $order) {
            $query->orderBy('data_inventaris.updated_at', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','data-inventaris.action')
        // ->editColumn('name', "Hi !")
        ->toJson();
    }

    public function getdataimport(Request $request){
        $logimport = LogImport::select('log_import.*');
        $datatables = Datatables::of($logimport);
        $datatables->orderColumn('created_at', function ($query, $order) {
            $query->orderBy('log_import.created_at', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','data-inventaris.log-import.action')
        ->toJson();
    }

    public function getdatadetailimport(Request $request){
        $logdetailimport = DetailLogImport::where('import_id', $request->id)->get();
        $datatables = Datatables::of($logdetailimport);

        return $datatables->addIndexColumn()
        ->toJson();
    }

    public function export_excel(Request $request)
    {

        // echo Request()->unit;

        $unit = request()->unit;
        if ($unit==null) {
            $unit = '';
        }
        $kondisi = request()->kondisi;
        if ($kondisi==null) {
            $kondisi = '';
        }
        $kodebarang = request()->kodebarang;
        if ($kodebarang==null) {
            $kodebarang = '';
        }
        $tahunpengadaan = request()->tahunpengadaan;
        if ($tahunpengadaan==null) {
            $tahunpengadaan = '';
        }
        $koderuangan = request()->koderuangan;
        if ($koderuangan==null) {
            $koderuangan = '';
        }
        $nup = request()->nup;
        if ($nup==null) {
            $nup = '';
        }
        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan export excel data inventaris',

            'user_role' => Roles::find(Auth::user()->role_id)->name,
        ]);
        return (new DataInventarisExport($unit,$kondisi,$koderuangan,$tahunpengadaan,$kodebarang,$nup))->download('Data-Inventaris.xlsx');
        // return (new DataInventarisExport)->download('app.xls');
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

        $importsdata = LogImport::create([
            'total' => '',
            'success' => '',
            'failed' => ''
        ]);

        $importId = $importsdata->id;

        $file = $request->file('fileimport')->getRealPath();
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

                'user_role' => Roles::find(Auth::user()->role_id)->name,
            ]);

            if ($import->failures()->isNotEmpty()) {
                return redirect(route('data-inventaris.import'))->with('error', 'Berhasil melakukan impor');
            } else {
                return redirect(route('data-inventaris.import'))->with('success', 'Berhasil melakukan impor');
            }
        }

    }

    public function filter_data(Request $request)
    {

        function convertharga($harga)
        {
            return strrev(implode('.', str_split(strrev(strval($harga)), 3)));
        };

        $data = DataInventaris::all();

        if ($request->unit != null) {
            $data = $data->where('unit', $request->unit);
        }
        if ($request->kondisi != null) {
            $data = $data->where('kondisi', $request->kondisi);
        }
        if ($request->status != null) {
            $data = $data->where('status', $request->status);
        }
        if ($request->koderuangan != null) {
            $data = $data->where('kode_ruangan', $request->koderuangan);
        }
        if ($request->tahunpengadaan != null) {
            $data = $data->where('tahun_pengadaan', $request->ruangan);
        }
        if ($request->kodebarang != null) {
            $data = $data->where('kode', $request->kodebarang);
        }
        if ($request->nup != null) {
            $data = $data->where('nup', $request->nup);
        }


        $hargatotal = 0;
        foreach ($data as $key => $value) {
            $hargatotal = $hargatotal + $this->RemoveSpecialChar($value['harga_satuan']);
        }

        $hargatotal = 'Rp ' . convertharga($hargatotal);
        $jumlahinventaris = $data->count();
        $baik = $data->where('kondisi', 'Baik')->count();
        $rusakringan = $data->where('kondisi', 'Rusak Ringan')->count();
        $rusakberat = $data->where('kondisi', 'Rusak Berat')->count();

        // $datas = $data->get();
        // $activebill = 0;
        // $successharga = 0;
        // $notharga = 0;
        // foreach ($datas as $key => $value) {
        //     if ($value->bill_status == 'Aktif') {
        //         $activebill += 1;
        //     }
        //     if ($value->harga_status == 'Lunas') {
        //         $successharga += 1;
        //     }
        //     if ($value->harga_status == 'Belum Dibayar') {
        //         $notharga += 1;
        //     }
        // }


        return response()->json([
            'hargatotal' => $hargatotal,
            'jumlahinventaris' => $jumlahinventaris,
            'baik' => $baik,
            'rusakringan' => $rusakringan,
            'rusakberat' => $rusakberat,
        ]);
    }

    public function get_ruangan(Request $request)
    {
        $ruangan = DataRuangan::where('kode_ruangan', $request->kode)->first();

        return response()->json([
            'data' => $ruangan->nama_ruangan,
        ]);
    }
}
