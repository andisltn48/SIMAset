<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataPeminjaman;
use App\DataAset;
use App\User;
use App\AktivitasSistem;
use App\Roles;
use App\ListBarangPinjam;
Use Validator;
Use Auth;
Use PDF;
use Notification;
use Illuminate\Support\Str;
use Mail;
use App\Notifications\PeminjamNotification;

class PeminjamanController extends Controller
{
    public function peminjaman()
    {
        $datapeminjaman = DataPeminjaman::where('status_peminjaman', 'Dalam Peminjaman')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $datapeminjaman   
        ], 200);
    }

    public function permintaan_peminjaman()
    {
        $datapeminjaman = DataPeminjaman::where('status_permintaan', 'Belum Dikonfirmasi')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $datapeminjaman   
        ], 200);
    }

    public function detail($id)
    {
        $datapeminjaman = DataPeminjaman::where('status_peminjaman', 'Dalam Peminjaman')->where('id', $id)->first();
        if (!$datapeminjaman) {
            return response()->json([
                'message' => 'Data peminjaman tidak ditemukan', 
            ], 404);
        }
        return response()->json([
            'message' => 'Success',
            'data' => $datapeminjaman   
        ], 200);
    }

    public function confirm_request(Request $request, $no_peminjaman)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

        $datapermintaan = DataPeminjaman::where('no_peminjaman', $no_peminjaman)->where('status_permintaan','Belum Dikonfirmasi')->first();
        
        if (!$datapermintaan) {
            return response()->json([
                'message' => 'Data permintaan tidak ditemukan atau sudah dikonfirmasi', 
            ], 404);
        }
        $dataPeminjam = User::where('id',$datapermintaan->id_peminjam)->first();
        $listbarangpinjam = ListBarangPinjam::where('no_peminjaman', $no_peminjaman)->get();

        if ($request->status == 'Disetujui') {
            
            /*@ Reading doc file */
            $template = new\PhpOffice\PhpWord\TemplateProcessor(public_path('template-surat-balasan/Format surat balasan.docx'));
    
            $tanggalPeminjaman = $datapermintaan->tanggal_awal_penggunaan." s/d ".$datapermintaan->tanggal_akhir_penggunaan;
            /*@ Replacing variables in doc file */
            $template->setValue('peminjam', $dataPeminjam->name);
            $template->setValue('hari_peminjaman', 'Senin');
            $template->setValue('waktu_peminjaman', $tanggalPeminjaman);
            $template->cloneRow('row',count($listbarangpinjam));

            foreach ($listbarangpinjam as $key => $value) {
                $template->setValue('row#'.($key+1), $key+1);
                $template->setValue('nama_aset#'.($key+1), $value->nama_barang);
                $template->setValue('kode_barang#'.($key+1), $value->kode_barang);
                $template->setValue('nup#'.($key+1), $value->nup_barang);
            }

            // dd(count($listbarangpinjam));

            $saveDocPath = public_path('tempo-surat-balasan.docx');
            $template->saveAs($saveDocPath);
    
            /*@ Remove temporarily created word file */
            // if ( file_exists($saveDocPath) ) {
            //     unlink($saveDocPath);
            // }

            // $file_suratbalasan->move(public_path('storage/file-peminjaman/surat-balasan'), $fileName_suratbalasan);
            $datapermintaan->update([
                'status_permintaan' => $request->status,
                'status_peminjaman' => 'Dalam Peminjaman',
                'surat_balasan' => 'fileName_suratbalasan',
                'catatan' => $request->catatan
            ]);

            // $files = \Storage::path('public/file-peminjaman/surat-balasan/'.$fileName_suratbalasan);
            $files = $saveDocPath;

            Mail::send('suratBalasanView', ['dataPeminjam' => $dataPeminjam], function($message) use($dataPeminjam, $files){
                $message->to($dataPeminjam->email);
                $message->subject('Surat balasan peminjaman');
                $message->attach($files);
            });
        } else {
            $datapermintaan->update([
                'status_permintaan' => $request->status,
                'catatan' => $request->catatan
            ]);
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
            'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
        ]);

        return response()->json([
            'message'=>'Berhasil melakukan konfirmasi permintaan peminjaman',
            'data' => DataPeminjaman::where('no_peminjaman', $no_peminjaman)->first()
        ], 201);
    }

    public function storepermintaan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_peminjam' =>'required',
            'penanggung_jawab' => 'required',
            'id_aset' => 'required',
            'tanggal_awal_penggunaan' => 'required',
            'tanggal_akhir_penggunaan' =>'required',
            'surat_peminjaman' => 'required',
            'datadiri_penanggungjawab' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } 

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
    
        $dataaset = DataAset::where('id', $request->id_aset)->first();

        if (!$dataaset) {
            if (!$datapermintaan) {
                return response()->json([
                    'message' => 'Data aset tidak ditemukan', 
                ], 404);
            }
        }
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
            'id_barang' => $dataaset->id,
            'nama_barang' => $dataaset->nama_barang,
            'kode_barang' => $dataaset->kode,
            'nup_barang' => $dataaset->nup,
            'kondisi' => $dataaset->kondisi
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
            'user_role' => Roles::where('id',Auth::user()->role_id)->pluck('name'),
        ]);

        return response()->json([
            'message'=>'Berhasil melakukan permintaan peminjaman',
            'data' => $datapeminjaman
        ], 201);
    }
}
