<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataAset;
use App\Unit;
use App\LogImport;
use App\DetailLogImport;
use Yajra\Datatables\Datatables;
use App\Exports\DataAsetExport;
use App\Imports\DataAsetImport;
use Maatwebsite\Excel\Facades\Excel;

class DataAsetController extends Controller
{
    public function index()
    {
        function convert($harga)
        {
            return strrev(implode('.', str_split(strrev(strval($harga)), 3)));
        };

        function RemoveSpecialChar($str) {
            $res = str_replace( array( '.' ), '', $str);

            return $res;
        }

        $dataaset = DataAset::all();
        $hargatotal = 0;
        foreach ($dataaset as $key => $value) {
            $hargatotal = $hargatotal + RemoveSpecialChar($value['harga_total']);
        }
        
        $hargatotal = 'Rp ' . convert($hargatotal);
        
        $jumlahaset = DataAset::all()->count();
        $rusakringan = DataAset::where('kondisi', 'Rusak Ringan')->count();
        $rusakberat = DataAset::where('kondisi', 'Rusak Berat')->count();
        $unit = Unit::all();
        return view('data-aset/index', ['unit'=>$unit], compact('hargatotal', 'jumlahaset', 'rusakringan', 'rusakberat'));
    }

    public function create()
    {
        $kondisi = [
            'Baik' => 'Baik',
            'Rusak Ringan' => 'Rusak Ringan',
            'Rusak Berat' => 'Rusak Berat'
        ];
        $unit = Unit::all();
        return view('data-aset/tambah',['unit' => $unit, 'kondisi' => $kondisi]);
    }

    public function store(Request $request)
    {
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
                $cekdata = DataAset::where('kode', $request->kode_barang)->where('nup', $current_nup)->get();
                if ($cekdata->count() == 0) {
                    
                $dataaset_save = DataAset::create([
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
                    'ruangan' => $request->ruangan,
                    'catatan' => $request->catatan,
                ]);
                } else {
                    return redirect(route('data-aset.create'))->with('error','Data Aset dengan Kode barang dan NUP yang sama telah terdaftar');
                }
                
            }
        } else {
            $cekdata = DataAset::where('kode', $request->kode_barang)->where('nup', $request->nup_awal)->get();
            if ($cekdata->count() == 0) {
                
            $dataaset_save = DataAset::create([
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
                'ruangan' => $request->ruangan,
                'catatan' => $request->catatan,
            ]);
            } else {
                $message = 'Data Aset dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup.' telah terdaftar!';
            return redirect(route('data-aset.create'))->with('error',$message);
            }
        
        }
        
        return redirect(route('data-aset.index'))->with('success','Data Aset berhasil ditambahkan');
        
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        // echo ($id);
        $dataaset = DataAset::where('id',$id)->first();
        $kondisi = [
            'Baik' => 'Baik',
            'Rusak Ringan' => 'Rusak Ringan',
            'Rusak Berat' => 'Rusak Berat'
        ];

        $unit = Unit::all();
        return view('data-aset.edit', compact('dataaset'), ['kondisi' => $kondisi, 'unit'=>$unit]);
        // var_dump($dataaset);
    }

    public function update(Request $request, $id)
    {
        echo $id;
        $validate = $request->validate([
            'kode_barang' => 'numeric',
            'jumlah_barang' => 'numeric',
            'nomor_sp2d' => 'numeric',
            'nup' => 'numeric'
        ]);

        $cekdata = DataAset::where('kode', $request->kode_barang)->where('nup', $request->nup)->get();

        if ($cekdata->count() == 0) {
            function RemoveSpecialChar($str) {
                $res = str_replace( array( '.' ), '', $str);
    
                return $res;
            }
    
            $harga_satuan = RemoveSpecialChar($request->harga_satuan);
            $harga_total = RemoveSpecialChar($request->harga_total);
            $nilai_tagihan = RemoveSpecialChar($request->nilai_tagihan);
            $date_sp2d = date('d-m-Y H:i:s', strtotime($request->tanggal_sp2d));
    
            $dataaset_save = DataAset::where('id',$id)->update([
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
                'ruangan' => $request->ruangan,
                'catatan' => $request->catatan,
            ]);
            if ($dataaset_save) {
                return redirect(route('data-aset.index'))->with('success','Data Aset berhasil diedit');
            }
        } else {
            $message = 'Data Aset dengan Kode Barang: '.$request->kode_barang.' dan NUP: '.$request->nup.' telah terdaftar!';
            return redirect(route('data-aset.edit', $id))->with('error',$message);
        }
        

        
    }
    
    public function destroy($id)
    {
        $dataaset = DataAset::where('id', $id)->delete();
        if ($dataaset) {
            return redirect(route('data-aset.index'))->with('success','Data Aset berhasil dihapus');
        }
    }

    public function destroy_log_import($id)
    {
        $riwayat = LogImport::where('id', $id)->first();
        $detailriwayat = DetailLogImport::where('import_id', $riwayat->id)->get();

        foreach ($detailriwayat as $key => $value) {
            $value->delete();
        }
        $riwayat = $riwayat->delete();
        if ($riwayat) {
            return redirect(route('data-aset.import'))->with('success','Data Aset berhasil dihapus');
        }
    }

    public function import(){
        return view('data-aset.import');
    }

    public function detail_riwayat_import($id){
        $import_id = $id;
        return view('data-aset.detail-log-import', compact('import_id'));
    }

    public function getdatatable(Request $request){
        function convert($harga)
        {
            return strrev(implode('.', str_split(strrev(strval($harga)), 3)));
        };

        $dataaset = DataAset::leftjoin('units', 'units.kode_unit', 'data_aset.unit')
            ->select('data_aset.*',  'units.nama_unit');

        if ($request->input('unit') != null) {
            $dataaset = $dataaset->where('units.kode_unit', $request->unit);
        }
        if ($request->input('kondisi') != null) {
            $dataaset = $dataaset->where('kondisi', $request->kondisi);
        }
        if ($request->input('koderuangan') != null) {
            $dataaset = $dataaset->where('kode_ruangan', $request->koderuangan);
        }
        if ($request->input('ruangan') != null) {
            $dataaset = $dataaset->where('ruangan', $request->ruangan);
        }
        if ($request->input('kodebarang') != null) {
            $dataaset = $dataaset->where('kode', $request->kodebarang);
        }
        if ($request->input('nup') != null) {
            $dataaset = $dataaset->where('nup', $request->nup);
        }
        // if ($request->input('status') != null) {
        //     $dataaset = $dataaset->where('status', $request->status);
        // }
        $datatables = Datatables::of($dataaset);

        if ($request->get('search')['value']) {
            $datatables->filter(function ($query) {
                    $keyword = request()->get('search')['value'];
                    $query->where('nama_barang', 'like', "%" . $keyword . "%");
                
        });}
        $datatables->orderColumn('updated_at', function ($query, $order) {
            $query->orderBy('data_aset.updated_at', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','data-aset.action')
        ->toJson();
    }

    public function getdataimport(Request $request){
        $logimport = LogImport::select('log_import.*');
        $datatables = Datatables::of($logimport);
        $datatables->orderColumn('created_at', function ($query, $order) {
            $query->orderBy('log_import.created_at', $order);
        });
        return $datatables->addIndexColumn()
        ->addColumn('action','data-aset.log-import.action')
        ->toJson();
    }

    public function getdatadetailimport(Request $request){
        $logdetailimport = DetailLogImport::where('import_id', $request->id)->get();
        $datatables = Datatables::of($logdetailimport);
       
        return $datatables->addIndexColumn()
        ->toJson();
    }

    public function export_excel()
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
        $ruangan = request()->ruangan;
        if ($ruangan==null) {
            $ruangan = '';
        }
        $koderuangan = request()->koderuangan;
        if ($koderuangan==null) {
            $koderuangan = '';
        }
        $nup = request()->nup;
        if ($nup==null) {
            $nup = '';
        }
        return (new DataAsetExport($unit,$kondisi,$koderuangan,$ruangan,$kodebarang,$nup))->download('Data-Aset.xlsx');
        // return (new DataAsetExport)->download('app.xls');
    }

    public function import_template(){
        $filepath = public_path('template-import-aset/DATA ASET-Template.xlsx');
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
        $import = new DataAsetImport($importId);
        $import->import($file);

        $currentrow= 0;
        $freewalk=0;

        // if ($import->failures()->isNotEmpty()) {
        //     foreach ($import->failures() as $rows) {
        //         if ($freewalk==0) {
        //             $failed = DetailLogImport::create([
        //                 'row' => $rows->values()["no"],
        //                 'nama' => $rows->values()["nama_barang"],
        //                 'status' => 'Failed',
        //                 'message' => $rows->errors()[0],
        //                 'import_id' => $importId
        //             ]);
                    
        //             $freewalk = $freewalk+1;
        //         } else {
        //             if ($rows->row() != $currentrow) {
        //                 $failed = DetailLogImport::create([
        //                     'row' => $rows->values()["no"],
        //                     'nama' => $rows->values()["nama_barang"],
        //                     'status' => 'Failed',
        //                     'message' => $rows->errors()[0],
        //                     'import_id' => $importId
        //                 ]);
        //             }
        //         }
        //         $currentrow = $rows->row();
        //     }
        // }

        if ($import->failures()->isNotEmpty()) {
            foreach ($import->failures() as $rows) {
                $failed = DetailLogImport::create([
                    'row' => $rows->values()["no"],
                    'nama' => $rows->values()["nama_barang"],
                    'status' => 'Failed',
                    'message' => $rows->errors()[0],
                    'import_id' => $importId
                ]);
            }
        }

        $total = DetailLogImport::where('import_id', $importId)->count();
        $success = DetailLogImport::where('import_id', $importId)->where('status', 'Success')->count();
        $failed = DetailLogImport::where('import_id', $importId)->where('status', 'Failed')->count();
        $importsdata = LogImport::where('id', $importId)->update([
            'total' => $total,
            'success' => $success,
            'failed' => $failed
        ]);

        if ($importsdata != NULL) {
            return redirect(route('data-aset.import'))->with('success', 'Berhasil melakukan impor');
        }
        
    }

    public function filter_data(Request $request)
    {

        function convertharga($harga)
        {
            return strrev(implode('.', str_split(strrev(strval($harga)), 3)));
        };

        $data = DataAset::all();

        if ($request->unit != null) {
            $data = $data->where('unit', $request->unit);
        }
        if ($request->kondisi != null) {
            $data = $data->where('kondisi', $request->kondisi);
        }
        if ($request->status != null) {
            $data = $data->where('status', $request->status);
        }
        
        function RemoveSpecialChar($str) {
            $res = str_replace( array( '.' ), '', $str);

            return $res;
        }

        $hargatotal = 0;
        foreach ($data as $key => $value) {
            $hargatotal = $hargatotal + RemoveSpecialChar($value['harga_total']);
        }
        
        $hargatotal = 'Rp ' . convertharga($hargatotal);
        $jumlahaset = $data->count();
        $asetaktif = $data->where('status', 'Aktif')->count();
        $asetnonaktif = $data->where('status', 'Non-aktif')->count();
        
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
            'jumlahaset' => $jumlahaset,
            'asetaktif' => $asetaktif,
            'asetnonaktif' => $asetnonaktif,
        ]);
    }
}
