<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\DataPeminjaman;
use App\DataAset;
use App\ListBarangPinjam;
use Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function formpeminjaman(){
        return view('peminjaman-user/index');
    }

    public function storepermintaan(Request $request)
    {
        $validate = $request->validate([
            'surat_peminjaman' => 'required',
            'datadiri_penanggungjawab' => 'required',
        ]);

        $no_peminjaman = 1;
        $DataPeminjaman = DataPeminjaman::all();
        if ($DataPeminjaman->count() != 0) {
            $no_peminjaman = $DataPeminjaman->max('no_peminjaman')+1;
        }

        $file_suratpeminjaman = Request()->surat_peminjaman;
        $fileName_suratpeminjaman = time().'_'.$file_suratpeminjaman->getClientOriginalName();
        $file_suratpeminjaman->move(public_path('storage/file-peminjaman/surat-peminjaman'), $fileName_suratpeminjaman);

        $file_data_diri_penanggungjawab = Request()->datadiri_penanggungjawab;
        $fileName_data_diri_penanggungjawab = time().'_'.$file_data_diri_penanggungjawab->getClientOriginalName();
        $file_data_diri_penanggungjawab->move(public_path('storage/file-peminjaman/data-diri-penanggungjawab'), $fileName_data_diri_penanggungjawab);

        // dd(\Session::get('tempo-data'));
        if (\Session::get('tempo-data') != NULL) {
            $aset_selected = \Session::get('tempo-data');
            $datapeminjaman = DataPeminjaman::create([
                'nama_peminjam' => $request->nama_peminjam,
                'nama_penanggung_jawab' => $request->penanggung_jawab,
                'id_peminjam' => Auth::user()['id'],
                'no_peminjaman' => $no_peminjaman,
                'jumlah' => count($aset_selected),
                'tanggal_penggunaan' => date('d-m-Y H:i', strtotime($request->tanggal_penggunaan)),
                'surat_peminjaman' => $fileName_suratpeminjaman,
                'surat_balasan' => '', 
                'data_diri_penanggung_jawab' => $fileName_data_diri_penanggungjawab,
                'status_peminjaman' => 'Belum Dikonfirmasi'
            ]);
            foreach ($aset_selected as $key => $value) {
                $dataaset = DataAset::where('id', $value)->first();
                $listbarangpinjam = ListBarangPinjam::create([
                    'no_peminjaman' => $no_peminjaman,
                    'nama_barang' => $dataaset->nama_barang,
                    'kode_barang' => $dataaset->kode,
                    'nup_barang' => $dataaset->nup,
                    'kondisi' => $dataaset->kondisi
                ]);
            }
            
            \Session::forget('tempo-data');
            return redirect()->back()->with('success', ' Permintaan peminjaman berhasil dilakukan');
        } else {
            $validate = $request->validate([
                'sarana' => 'required'
            ]);
            $dataaset = DataAset::where('id', $request->sarana)->first();
            $datapeminjaman = DataPeminjaman::create([ 
                'nama_peminjam' => $request->nama_peminjam,
                'id_peminjam' => Auth::user()['id'],
                'nama_penanggung_jawab' => $request->penanggung_jawab,
                'no_peminjaman' => $no_peminjaman,
                'jumlah' => 1,
                'tanggal_penggunaan' => date('d-m-Y H:i', strtotime($request->tanggal_penggunaan)),
                'surat_peminjaman' => $fileName_suratpeminjaman,
                'surat_balasan' => '', 
                'data_diri_penanggung_jawab' => $fileName_data_diri_penanggungjawab,
                'status_peminjaman' => 'Belum Dikonfirmasi'
            ]);
            
            return redirect()->back()->with('success', ' Permintaan peminjaman berhasil dilakukan');
        }
        
    }

    public function templatesurat(){
        return view('peminjaman-user/template-surat');
    }

    public function get_free_aset(Request $request)
    {
        // echo "$request->tanggal_penggunaan";
        // $kode_barang = DataPeminjaman::where('tanggal_penggunaan', $request->tanggal_penggunaan)->pluck('kode_barang')->all();
        // $nup_barang = DataPeminjaman::where('tanggal_penggunaan', $request->tanggal_penggunaan)->pluck('nup_barang')->all();
        $datapeminjaman_free = DataPeminjaman::where('tanggal_penggunaan', date('d-m-Y H:i', strtotime($request->tanggal_penggunaan)))
        ->where('status_peminjaman', 'Disetujui')->pluck('no_peminjaman')->all();
        $kode_barang = ListBarangPinjam::where('no_peminjaman', $datapeminjaman_free)->pluck('kode_barang')->all();
        $nup_barang = ListBarangPinjam::where('no_peminjaman', $datapeminjaman_free)->pluck('nup_barang')->all();
        $dataaset1 = DataAset::whereNotIn('kode', $kode_barang)->get();
        $dataaset2 = DataAset::where('kode', $kode_barang)->whereNotIn('nup', $nup_barang)->get();
        $fixdata = $dataaset1->merge($dataaset2); 
        return response()->json([
            'data' => $fixdata,
        ]);
    }

    public function temporary_data(Request $request){
        $dataaset = DataAset::where('id', $request->curr_id)->first();
        // $arrayBaru = $re
        $items = collect($request->items);
        \Session::put('tempo-data', $items);
        return response()->json([
            // 'data' => \Session::get('tempo-data'),
            'data2' => $dataaset

        ]);
    }

    public function list_permintaan_peminjaman()
    {
        $id_peminjam = Auth::user()['id'];
        return view('peminjaman-user.list-permintaan', compact('id_peminjam'));
    }

    public function get_data_permintaan_peminjaman(Request $request)
    {
        $datapeminjaman = DataPeminjaman::where('id_peminjam', $request->id);
        $datatables = Datatables::of($datapeminjaman);
        $datatables->orderColumn('updated_at', function ($query, $order) {
            $query->orderBy('data_peminjaman.created_at', $order);
        });
        return $datatables->addIndexColumn()
        ->editColumn('status_peminjaman', function(DataPeminjaman $datapeminjaman) {
            if ($datapeminjaman->status_peminjaman == 'Belum Dikonfirmasi') {
                return '<div style="background: rgb(203, 214, 255); border-radius: 2rem;" class="p-2 text-dark"><i class="far fa-clock me-2"></i>'.$datapeminjaman->status_peminjaman.'</div>';
            }
            if ($datapeminjaman->status_peminjaman == 'Disetujui') {
                return '<div style="background: rgb(197, 255, 205); border-radius: 2rem;" class="p-2 text-dark"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div>';
            }
            if ($datapeminjaman->status_peminjaman == 'Ditolak') {
                return '<div style="background: rgb(197, 255, 205); border-radius: 2rem;" class="p-2 text-dark"><i class="fas fa-check-circle me-2"></i>'.$datapeminjaman->status_peminjaman.'</div>';
            }
        })
        ->escapeColumns([])
        ->addColumn('download_surat_peminjaman','peminjaman-user.button-datatable.download-surat-peminjaman')
        ->addColumn('list_barang','peminjaman-user.button-datatable.detail-barang')
        ->addColumn('action','peminjaman-user.button-datatable.action')
        ->toJson();
    }

    public function data_from_no_peminjam(Request $request)
    {
        $data = ListBarangPinjam::where('no_peminjaman', $request->no_peminjaman);
        $datatables = Datatables::of($data);
        return $datatables->addIndexColumn()->toJson();
        // return response()->json([
        //     // 'data' => \Session::get('tempo-data'),
        //     'data' => $data

        // ]);

    }

    public function download_surat_peminjaman($no_peminjaman)
    {
        $datapeminjaman = DataPeminjaman::where('no_peminjaman', $no_peminjaman)->first();
        return response()->download(public_path('storage/file-peminjaman/surat-peminjaman/'. $datapeminjaman->surat_peminjaman));
    }
}
