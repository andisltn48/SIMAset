<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataAset;
use App\DataPeminjaman;
use App\ListBarangPinjam;

class LaporanAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $currentTahun = date("Y");
        $jumlahaset = DataAset::all()->count();
        $kondisiAsetBaik = DataAset::where('kondisi', 'Baik')->count();
        $kondisiAsetRusakRingan = DataAset::where('kondisi', 'Rusak Ringan')->count();
        $kondisiAsetRusakBerat = DataAset::where('kondisi', 'Rusak Berat')->count();
        $totalBarangPinjam = 0;
        $datapeminjaman = DataPeminjaman::where('status_peminjaman', 'Dalam Peminjaman')->get();
        foreach ($datapeminjaman as $key => $value) {
          $databarang = ListBarangPinjam::where('no_peminjaman', $value->no_peminjaman)->get();
          foreach ($databarang as $key => $item) {
             $totalBarangPinjam =+ 1;
          }
        }
        $totalBarangTidakPinjam = $jumlahaset - $totalBarangPinjam;

        $dataaset = DataAset::all();
        $hargatotal = 0;
        foreach ($dataaset as $key => $value) {
            $hargatotal = $hargatotal + RemoveSpecialChar($value['harga_total']);
        }

        $hargatotal = 'Rp ' . convert($hargatotal);

        return view('laporan-aset.index', compact('jumlahaset',
        'kondisiAsetBaik',
        'kondisiAsetRusakRingan',
        'kondisiAsetRusakBerat',
        'totalBarangPinjam',
        'totalBarangTidakPinjam',
        'hargatotal',
        'currentTahun'));
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
}
