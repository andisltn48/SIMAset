<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use CloudConvert\Laravel\Facades\CloudConvert;
use App\DataPeminjaman;
use App\DataInventaris;
use App\User;
use App\AktivitasSistem;
use App\ListBarangPinjam;
use App\Roles;
use Auth;
Use PDF;
use Notification;
use Illuminate\Support\Str;
use Mail;
use App\Notifications\PeminjamNotification;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peminjaman-admin.index');
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
            $inventaris_selected = \Session::get('tempo-data');
            $datapeminjaman = DataPeminjaman::create([
                'nama_peminjam' => $request->nama_peminjam,
                'nama_penanggung_jawab' => $request->penanggung_jawab,
                'id_peminjam' => Auth::user()['id'],
                'no_peminjaman' => $no_peminjaman,
                'jumlah' => count($inventaris_selected),
                'tanggal_awal_penggunaan' => date('d-m-Y H:i', strtotime($request->tanggal_awal_penggunaan)),
                'tanggal_akhir_penggunaan' => date('d-m-Y H:i', strtotime($request->tanggal_akhir_penggunaan)),
                'surat_peminjaman' => $fileName_suratpeminjaman,
                'surat_balasan' => '',
                'data_diri_penanggung_jawab' => $fileName_data_diri_penanggungjawab,
                'status_permintaan' => 'Belum Dikonfirmasi',
                'status_peminjaman' => '-',
                'saran' => $request->saran
            ]);
            foreach ($inventaris_selected as $key => $value) {
                $datainventaris = DataInventaris::where('id', $value)->first();
                $listbarangpinjam = ListBarangPinjam::create([
                    'no_peminjaman' => $no_peminjaman,
                    'id_barang' => $datainventaris->id,
                    'nama_barang' => $datainventaris->nama_barang,
                    'kode_barang' => $datainventaris->kode,
                    'nup_barang' => $datainventaris->nup,
                    'kondisi' => $datainventaris->kondisi
                ]);
            }

            \Session::forget('tempo-data');
            $user = User::where('role_id', '4')->get();
            $details = [
                'body' => 'Permintaan peminjaman dengan no peminjaman: '.$datapeminjaman->no_peminjaman.' menunggu konfirmasi'
            ];
            foreach ($user as $key => $value) {
                Notification::send($value, new PeminjamNotification($details));
            }

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan permintaan peminjaman',

                'user_role' => Roles::find(Auth::user()->role_id)->name
            ]);

            return redirect()->back()->with('success', ' Permintaan peminjaman berhasil dilakukan');
        } else {
            $validate = $request->validate([
                'sarana' => 'required'
            ]);
            $datainventaris = DataInventaris::where('id', $request->sarana)->first();
            $datapeminjaman = DataPeminjaman::create([
                'nama_peminjam' => $request->nama_peminjam,
                'id_peminjam' => Auth::user()['id'],
                'nama_penanggung_jawab' => $request->penanggung_jawab,
                'no_peminjaman' => $no_peminjaman,
                'jumlah' => 1,
                'tanggal_awal_penggunaan' => date('d-m-Y H:i', strtotime($request->tanggal_awal_penggunaan)),
                'tanggal_akhir_penggunaan' => date('d-m-Y H:i', strtotime($request->tanggal_akhir_penggunaan)),
                'surat_peminjaman' => $fileName_suratpeminjaman,
                'surat_balasan' => '',
                'data_diri_penanggung_jawab' => $fileName_data_diri_penanggungjawab,
                'status_permintaan' => 'Belum Dikonfirmasi',
                'status_peminjaman' => '-',
                'saran' => $request->saran
            ]);
            $listbarangpinjam = ListBarangPinjam::create([
                'no_peminjaman' => $no_peminjaman,
                'id_barang' => $datainventaris->id,
                'nama_barang' => $datainventaris->nama_barang,
                'kode_barang' => $datainventaris->kode,
                'nup_barang' => $datainventaris->nup,
                'kondisi' => $datainventaris->kondisi
            ]);
            $user = User::where('role_id', '4')->get();
            $details = [
                'body' => 'Permintaan peminjaman dengan no peminjaman: '.$datapeminjaman->no_peminjaman.' menunggu konfirmasi'
            ];
            foreach ($user as $key => $value) {
                Notification::send($value, new PeminjamNotification($details));
            }

            $activity = AktivitasSistem::create([
                'user_id' => Auth::user()->id,
                'user_activity' => Auth::user()->name.' melakukan permintaan peminjaman',

                'user_role' => Roles::find(Auth::user()->role_id)->name
            ]);

            return redirect()->back()->with('success', ' Permintaan peminjaman berhasil dilakukan');
        }

    }

    public function templatesurat(){
        return view('peminjaman-user/template-surat');
    }

    public function get_free_inventaris(Request $request)
    {
        // $datapeminjaman_free = DataPeminjaman::where('status_peminjaman', '!=', 'Peminjaman Selesai');
        if ($request->tanggal_awal_penggunaan != NULL && $request->tanggal_akhir_penggunaan != NULL) {
            $tanggal_awal_penggunaan = date('d-m-Y H:i', strtotime($request->tanggal_awal_penggunaan));
            $tanggal_akhir_penggunaan = date('d-m-Y H:i', strtotime($request->tanggal_akhir_penggunaan));
            $tanggal_akhir_penggunaan =  new \DateTime($tanggal_akhir_penggunaan);
            $tanggal_akhir_penggunaan->modify('+1 Minute');

            $period = new \DatePeriod(
                new \DateTime($tanggal_awal_penggunaan),
                new \DateInterval('PT1M'),
                $tanggal_akhir_penggunaan,
            );

            // $period = iterator_to_array($period);

            foreach ($period as $key => $value) {
                $arrDates[] = $value->format('d-m-Y H:i');  
            }

            $datapeminjaman = DataPeminjaman::where('status_peminjaman', '!=', 'Peminjaman Selesai')->select('no_peminjaman', 'tanggal_awal_penggunaan', 'tanggal_akhir_penggunaan')->get();
            
            $arrDates2 = null;
            $arrNoPeminjaman = null;
            foreach ($datapeminjaman as $key => $value) {
                $tanggal_akhir_penggunaans =  new \DateTime($value->tanggal_akhir_penggunaan);
                $tanggal_akhir_penggunaans->modify('+1 Minute');
                $periods = new \DatePeriod(
                    new \DateTime($value->tanggal_awal_penggunaan),
                    new \DateInterval('PT1M'),
                    $tanggal_akhir_penggunaans,
                );

                foreach ($periods as $dataPeriod) {
                    $arrDates2[] = $dataPeriod->format('d-m-Y H:i');  
                }

                foreach ($arrDates2 as $dataDates) {
                    
                    if (in_array($dataDates,$arrDates)) {
                        // dd($dataDates);
                        $arrNoPeminjaman[] = $value->no_peminjaman;
                        break;
                    }
                }
                $arrDates2 = null;

            }
            
            // // echo "$request->tanggal_penggunaan";
            // // $kode_barang = DataPeminjaman::where('tanggal_penggunaan', $request->tanggal_penggunaan)->pluck('kode_barang')->all();
            // // $nup_barang = DataPeminjaman::where('tanggal_penggunaan', $request->tanggal_penggunaan)->pluck('nup_barang')->all();
            // // $datapeminjaman_free = DataPeminjaman::whereIn('tanggal_awal_penggunaan', $arrDates)
            // // ->orWhereIn('tanggal_akhir_penggunaan',$arrDates)
            // // ->where('status_peminjaman', '!=', 'Peminjaman Selesai')
            // // ->get();
            // dd($arrNoPeminjaman);
            
            if ($arrNoPeminjaman) {
                $kode_barang = ListBarangPinjam::whereIn('no_peminjaman', $arrNoPeminjaman)->pluck('kode_barang')->all();
            
                $nup_barang = ListBarangPinjam::whereIn('no_peminjaman', $arrNoPeminjaman)->pluck('nup_barang')->all();
                $datainventaris1 = DataInventaris::whereNotIn('kode', $kode_barang)->get();
                $datainventaris2 = DataInventaris::whereIn('kode', $kode_barang)->whereNotIn('nup', $nup_barang)->get();
                $fixdata = $datainventaris1->merge($datainventaris2);
            } else {
                $fixdata = DataInventaris::all();
            }
            
            return response()->json([
                'data' => $fixdata,
            ]);
            
        }
        
    }

    public function temporary_data(Request $request){
        $datainventaris = DataInventaris::where('id', $request->curr_id)->first();
        // $arrayBaru = $re
        $items = collect($request->items);
        \Session::put('tempo-data', $items);
        return response()->json([
            // 'data' => \Session::get('tempo-data'),
            'data2' => $datainventaris

        ]);
    }

    public function list_permintaan_peminjaman()
    {
        $id_peminjam = Auth::user()['id'];
        return view('peminjaman-user.list-permintaan', compact('id_peminjam'));
    }

    public function list_peminjaman()
    {
        $id_peminjam = Auth::user()['id'];
        return view('peminjaman-user.list-peminjaman', compact('id_peminjam'));
    }

    public function list_peminjaman_admin()
    {
        return view('peminjaman-admin.list-peminjaman');
    }

    public function get_data_permintaan_peminjaman(Request $request)
    {
        if ($request->id != NULL) {
            $datapeminjaman = DataPeminjaman::where('status_permintaan','Belum Dikonfirmasi')->where('id_peminjam', $request->id);
            $datatables = Datatables::of($datapeminjaman);
            if (isset($request->search['value'])) {
                $datatables->filter(function ($query) {
                        $keyword = request()->get('search')['value'];
                        $query->where('no_peminjaman', 'like', "%" . $keyword . "%");

            });}
            $datatables->orderColumn('updated_at', function ($query, $order) {
                $query->orderBy('data_peminjaman.updated_at', $order);
            });
            return $datatables->addIndexColumn()
            ->editColumn('status_permintaan', function(DataPeminjaman $datapeminjaman) {
                if ($datapeminjaman->status_permintaan == 'Belum Dikonfirmasi') {
                    return '<div style="background: rgb(203, 214, 255); border-radius: 2rem;" class="p-2 text-dark"><i class="far fa-clock me-2"></i>'.$datapeminjaman->status_permintaan.'</div>';
                }
            })
            ->escapeColumns([])
            ->addColumn('download_surat_peminjaman','peminjaman-user.button-datatable.download-surat-peminjaman')
            ->addColumn('list_barang','peminjaman-user.button-datatable.detail-barang')
            ->addColumn('action','peminjaman-user.button-datatable.action')
            ->toJson();
        } else {
            $datapeminjaman = DataPeminjaman::where('status_permintaan','Belum Dikonfirmasi')->select('data_peminjaman.*');
            $datatables = Datatables::of($datapeminjaman);
            if (isset($request->search['value'])) {
                $datatables->filter(function ($query) {
                        $keyword = request()->get('search')['value'];
                        $query->where('no_peminjaman', 'like', "%" . $keyword . "%");

            });}
            $datatables->orderColumn('updated_at', function ($query, $order) {
                $query->orderBy('data_peminjaman.updated_at', $order);
            });
            return $datatables->addIndexColumn()
            ->editColumn('status_permintaan', function(DataPeminjaman $datapeminjaman) {
                if ($datapeminjaman->status_permintaan == 'Belum Dikonfirmasi') {
                    return '<div style="background: rgb(203, 214, 255); border-radius: 2rem;" class="p-2 text-dark"><i class="far fa-clock me-2"></i>'.$datapeminjaman->status_permintaan.'</div>';
                }
            })
            ->escapeColumns([])
            ->addColumn('download_surat_peminjaman','peminjaman-admin.button-datatable.download-surat-peminjaman')
            ->addColumn('download_data_diri_penanggung_jawab','peminjaman-admin.button-datatable.download-data-diri-penanggungjawab')
            ->addColumn('list_barang','peminjaman-admin.button-datatable.detail-barang')
            ->addColumn('action','peminjaman-admin.button-datatable.action')
            ->toJson();
        }

    }

    public function get_data_peminjaman(Request $request)
    {
        if ($request->id != NULL) {
            $datapeminjaman = DataPeminjaman::where('id_peminjam', $request->id)->where('status_permintaan', '!=', 'Belum Dikonfirmasi');
            $datatables = Datatables::of($datapeminjaman);
            if (isset($request->search['value'])) {
                $datatables->filter(function ($query) {
                        $keyword = request()->get('search')['value'];
                        $query->where('no_peminjaman', 'like', "%" . $keyword . "%");

            });}
            $datatables->orderColumn('updated_at', function ($query, $order) {
                $query->orderBy('data_peminjaman.updated_at', $order);
            });
            return $datatables->addIndexColumn()
            ->editColumn('status_peminjaman', function(DataPeminjaman $datapeminjaman) {
                if ($datapeminjaman->status_peminjaman == 'Dalam Peminjaman') {
                    return '<div style="background: rgb(255,255,51); border-radius: 2rem;" class="p-2 text-center text-dark">'.$datapeminjaman->status_peminjaman.'</div>';
                } elseif ($datapeminjaman->status_permintaan == 'Ditolak') {
                    return '<div style="background: rgb(255,0,0); border-radius: 2rem;" class="p-2 text-center text-white">'.$datapeminjaman->status_permintaan.'</div>';
                } elseif ($datapeminjaman->status_permintaan == 'Disetujui') {
                    return '<div style="background: rgb(50,205,50); border-radius: 2rem;" class="p-2 text-center text-dark">'.$datapeminjaman->status_permintaan.'</div>';
                }
                
            })
            ->escapeColumns([])
            ->addColumn('download_surat_balasan','peminjaman-user.button-datatable.download-surat-balasan')
            ->addColumn('list_barang','peminjaman-user.button-datatable.detail-barang')
            ->toJson();
        } else {
            $datapeminjaman = DataPeminjaman::where('status_permintaan','!=','Belum Dikonfirmasi');
            $datatables = Datatables::of($datapeminjaman);
            if (isset($request->search['value'])) {
                $datatables->filter(function ($query) {
                        $keyword = request()->get('search')['value'];
                        $query->where('nama_peminjam', 'like', "%" . $keyword . "%");

            });}
            $datatables->orderColumn('updated_at', function ($query, $order) {
                $query->orderBy('data_peminjaman.updated_at', $order);
            });
            return $datatables->addIndexColumn()
            ->editColumn('status_peminjaman', function(DataPeminjaman $datapeminjaman) {
                if ($datapeminjaman->status_peminjaman == 'Dalam Peminjaman') {
                    return '<div style="background: rgb(255,255,51); border-radius: 2rem;" class="p-2 text-center text-dark">'.$datapeminjaman->status_peminjaman.'</div>';
                } elseif ($datapeminjaman->status_peminjaman == 'Ditolak') {
                    return '<div style="background: rgb(255,0,0); border-radius: 2rem;" class="p-2 text-center text-white">'.$datapeminjaman->status_permintaan.'</div>';
                } elseif ($datapeminjaman->status_permintaan == 'Disetujui') {
                    return '<div style="background: rgb(50,205,50); border-radius: 2rem;" class="p-2 text-center text-dark">'.$datapeminjaman->status_permintaan.'</div>';
                }
                
            })
            ->escapeColumns([])
            ->addColumn('download_surat_balasan','peminjaman-admin.button-datatable.download-surat-balasan')
            ->addColumn('list_barang','peminjaman-admin.button-datatable.detail-barang')
            ->addColumn('action','peminjaman-admin.button-datatable.action-peminjaman')
            ->toJson();
        }

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
    public function download_template_surat_peminjaman()
    {
        return response()->file(public_path('template-surat-peminjaman/Format surat peminjaman.docx'));
    }

    public function download_surat_peminjaman($surat_peminjaman)
    {
        $datapeminjaman = DataPeminjaman::where('surat_peminjaman', $surat_peminjaman)->first();
        return response()->file(public_path('storage/file-peminjaman/surat-peminjaman/'. $datapeminjaman->surat_peminjaman));
    }

    public function download_data_diri_penanggung_jawab($data_diri_penanggung_jawab)
    {
        $datapeminjaman = DataPeminjaman::where('data_diri_penanggung_jawab', $data_diri_penanggung_jawab)->first();
        return response()->file(public_path('storage/file-peminjaman/data-diri-penanggungjawab/'. $datapeminjaman->data_diri_penanggung_jawab));
    }

    public function download_surat_balasan($surat_balasan)
    {
        $datapeminjaman = DataPeminjaman::where('surat_balasan', $surat_balasan)->first();
        return response()->file(public_path('storage/file-peminjaman/surat-balasan/'. $datapeminjaman->surat_balasan.'.docx'));
    }

    public function destroy_permintaan($no_peminjaman)
    {
        $datapeminjaman = DataPeminjaman::where('no_peminjaman', $no_peminjaman)->first();
        $datapeminjaman->delete();
        // dd($datapeminjaman->nama_peminjam);
        $listbarangpinjam = ListBarangPinjam::where('no_peminjaman', $no_peminjaman)->get();
        foreach ($listbarangpinjam as $key => $value) {
            $value->delete();
        }

        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan hapus permintaan peminjaman',

            'user_role' => Roles::find(Auth::user()->role_id)->name
        ]);

        return redirect()->back()->with('success', 'Berhasil menghapus permintaan');
    }

    public function confirm_request(Request $request, $no_peminjaman)
    {
        // $file_suratbalasan = $request->surat_balasan;
        // $fileName_suratbalasan = time().'_'.$file_suratbalasan->getClientOriginalName();

        $datapermintaan = DataPeminjaman::where('no_peminjaman', $no_peminjaman)->first();
        $dataPeminjam = User::where('id',$datapermintaan->id_peminjam)->first();
        $listbarangpinjam = ListBarangPinjam::where('no_peminjaman', $no_peminjaman)->get();

        if ($request->status == 'Disetujui') {
            
            /*@ Reading doc file */
            $template = new\PhpOffice\PhpWord\TemplateProcessor(public_path('template-surat-balasan/Format surat balasan disetujui.docx'));
    
            $tanggalPeminjaman = $datapermintaan->tanggal_awal_penggunaan." s/d ".$datapermintaan->tanggal_akhir_penggunaan;
            /*@ Replacing variables in doc file */
            $currentDay = date('d');
            $currentMonth = date('m');
            $currentYear = date('Y');

            $arrayMonth = ['1'=>'Januari',
            '2'=>'Februari',
            '3'=>'Maret',
            '4'=>'April',
            '5'=>'Mei',
            '6'=>'Juni',
            '7'=>'Juli',
            '8'=>'Agustus',
            '9'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember'];

            foreach ($arrayMonth as $key => $value) {
                if($currentMonth == $key){
                    $currentMonth = $value;
                }
            }

            $template->setValue('peminjam', $dataPeminjam->name);
            $template->setValue('tanggal_sekarang', $currentDay.' '.$currentMonth.' '.$currentYear);
            $template->setValue('waktu_permintaan', $datapermintaan->created_at);
            $template->cloneRow('row',count($listbarangpinjam));

            foreach ($listbarangpinjam as $key => $value) {
                $template->setValue('row#'.($key+1), $key+1);
                $template->setValue('nama_inventaris#'.($key+1), $value->nama_barang);
                $template->setValue('kode_barang#'.($key+1), $value->kode_barang);
                $template->setValue('waktu_peminjaman#'.($key+1), $tanggalPeminjaman);
            }

            // dd(count($listbarangpinjam));

            $timeNow = time();
            $saveDocPath = public_path('storage\file-peminjaman\surat-balasan\surat-balasan-'.$timeNow.'.docx');
            $template->saveAs($saveDocPath);

    
            /*@ Remove temporarily created word file */
            // if ( file_exists($saveDocPath) ) {
            //     unlink($saveDocPath);
            // }

            // $file_suratbalasan->move(public_path('storage/file-peminjaman/surat-balasan'), $fileName_suratbalasan);
            $datapermintaan->update([
                'status_permintaan' => $request->status,
                'status_peminjaman' => 'Dalam Peminjaman',
                'surat_balasan' => 'surat-balasan-'.$timeNow,
                'catatan' => $request->catatan
            ]);

            // $files = \Storage::path('public/file-peminjaman/surat-balasan/'.$fileName_suratbalasan);
            $files = $saveDocPath;

            Mail::send('suratBalasanView', ['dataPeminjam' => $dataPeminjam, 'status' => 'disetujui'], function($message) use($dataPeminjam, $files){
                $message->to($dataPeminjam->email);
                $message->subject('Surat balasan peminjaman');
                $message->attach($files);
            });
        } else {

            $template = new\PhpOffice\PhpWord\TemplateProcessor(public_path('template-surat-balasan/Format surat balasan ditolak.docx'));
    
            $tanggalPeminjaman = $datapermintaan->tanggal_awal_penggunaan." s/d ".$datapermintaan->tanggal_akhir_penggunaan;
            /*@ Replacing variables in doc file */
            $currentDay = date('d');
            $currentMonth = date('m');
            $currentYear = date('Y');

            $arrayMonth = ['1'=>'Januari',
            '2'=>'Februari',
            '3'=>'Maret',
            '4'=>'April',
            '5'=>'Mei',
            '6'=>'Juni',
            '7'=>'Juli',
            '8'=>'Agustus',
            '9'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember'];

            foreach ($arrayMonth as $key => $value) {
                if($currentMonth == $key){
                    $currentMonth = $value;
                }
            }

            $template->setValue('peminjam', $dataPeminjam->name);
            $template->setValue('tanggal_sekarang', $currentDay.' '.$currentMonth.' '.$currentYear);
            $template->setValue('waktu_permintaan', $datapermintaan->created_at);
            $template->cloneRow('row',count($listbarangpinjam));

            foreach ($listbarangpinjam as $key => $value) {
                $template->setValue('row#'.($key+1), $key+1);
                $template->setValue('nama_inventaris#'.($key+1), $value->nama_barang);
                $template->setValue('kode_barang#'.($key+1), $value->kode_barang);
                $template->setValue('waktu_peminjaman#'.($key+1), $tanggalPeminjaman);
            }

            // dd(count($listbarangpinjam));

            $timeNow = time();
            $saveDocPath = public_path('storage\file-peminjaman\surat-balasan\surat-balasan-'.$timeNow.'.docx');
            $template->saveAs($saveDocPath);

            
            $datapermintaan->update([
                'status_permintaan' => $request->status,
                'status_peminjaman' => 'Ditolak',
                'surat_balasan' => 'surat-balasan-'.$timeNow,
                'catatan' => $request->catatan
            ]);
            

            // $files = \Storage::path('public/file-peminjaman/surat-balasan/'.$fileName_suratbalasan);
            $files = $saveDocPath;

            Mail::send('suratBalasanView', ['dataPeminjam' => $dataPeminjam, 'status' => 'ditolak'], function($message) use($dataPeminjam, $files){
                $message->to($dataPeminjam->email);
                $message->subject('Surat balasan peminjaman');
                $message->attach($files);
            });
        }


        $user = User::where('id', $datapermintaan->id_peminjam)->first();

        $details = [
            'body' => 'Permintaan peminjaman dengan no: '.$datapermintaan->no_peminjaman.' telah dikonfirmasi',
            'link' => route('peminjaman.getdatapermintaanpeminjaman')
        ];

        Notification::send($user, new PeminjamNotification($details));

        $activity = AktivitasSistem::create([
            'user_id' => Auth::user()->id,
            'user_activity' => Auth::user()->name.' melakukan konfirmasi permintaan peminjaman',

            'user_role' => Roles::find(Auth::user()->role_id)->name
        ]);

        return redirect()->back()->with('success', 'Berhasil melakukan konfirmasi');
    }

    public function done_peminjaman($id)
    {
      $data = DataPeminjaman::find($id);

      $data->update([
        'status_peminjaman' => 'Peminjaman Selesai'
      ]);
      $activity = AktivitasSistem::create([
          'user_id' => Auth::user()->id,
          'user_activity' => Auth::user()->name.' melakukan konfirmasi selesai peminjaman',

          'user_role' => Roles::find(Auth::user()->role_id)->name
      ]);
      return redirect()->back()->with('success', 'Berhasil menyelesaikan peminjaman');
    }

    public function destroy_peminjaman($id)
    {
      $data = DataPeminjaman::find($id);
      $data2 = ListBarangPinjam::where('no_peminjaman', $data->no_peminjaman)->get();
      foreach ($data2 as $key => $value) {
        $value->delete();
      }
      $data->delete();
      $activity = AktivitasSistem::create([
          'user_id' => Auth::user()->id,
          'user_activity' => Auth::user()->name.' melakukan hapus data peminjaman',

          'user_role' => Roles::find(Auth::user()->role_id)->name
      ]);
      return redirect()->back()->with('success', 'Berhasil menghapus peminjaman');
    }
}
