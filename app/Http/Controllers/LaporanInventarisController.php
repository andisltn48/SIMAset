<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataInventaris;
use App\DataPeminjaman;
use App\ListBarangPinjam;

class LaporanInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        function convert($harga)
        {
            return strrev(implode('.', str_split(strrev(strval($harga)), 3)));
        };

        function RemoveSpecialChar($str) {
            $res = str_replace( array( '.' ), '', $str);

            return $res;
        }

        if ($request->tahun != NULL) {
            $currentTahun = $request->tahun;
        } else {   
            $currentTahun = date("Y");
        }

        $jumlahinventaris = DataInventaris::all()->count();
        $kondisiInventarisBaik = DataInventaris::where('kondisi', 'Baik')->count();
        $kondisiInventarisRusakRingan = DataInventaris::where('kondisi', 'Rusak Ringan')->count();
        $kondisiInventarisRusakBerat = DataInventaris::where('kondisi', 'Rusak Berat')->count();
        $totalBarangPinjam = 0;
        $datapeminjaman = DataPeminjaman::where('status_peminjaman', 'Dalam Peminjaman')->get();
        foreach ($datapeminjaman as $key => $value) {
          $databarang = ListBarangPinjam::where('no_peminjaman', $value->no_peminjaman)->get();
          foreach ($databarang as $key => $item) {
             $totalBarangPinjam += 1;
          }
        }
        $totalBarangTidakPinjam = $jumlahinventaris - $totalBarangPinjam;

        $datainventaris = DataInventaris::all();
        $hargatotal = 0;
        foreach ($datainventaris as $key => $value) {
            $hargatotal = $hargatotal + RemoveSpecialChar($value['harga_satuan']);
        }

        $hargatotal = 'Rp ' . convert($hargatotal);

        //bulan
        $Januari = 0;
        $Februari = 0;
        $Maret = 0;
        $April = 0;
        $Mei = 0;
        $Juni = 0;
        $Juli = 0;
        $Agustus = 0;
        $September = 0;
        $Oktober = 0;
        $November = 0;
        $Desember = 0;
        $hargaInventarisByTahun = 0;

        foreach ($datainventaris as $key => $value) {
          $date = strtotime($value->created_at);
          if (date("Y", $date) == $currentTahun) {
            $hargaInventarisByTahun += RemoveSpecialChar($value['harga_satuan']);
            if (date("n", $date) == 1) {
                $Januari += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 2) {
                $Februari += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 3) {
                $Maret += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 4) {
                $April += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 5) {
                $Mei += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 6) {
                $Juni += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 7) {
                $Juli += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 8) {
                $Agustus += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 9) {
                $September += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 10) {
                $Oktober += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 11) {
                $November += RemoveSpecialChar($value['harga_satuan']);
            } elseif (date("n", $date) == 12) {
                $Desember += RemoveSpecialChar($value['harga_satuan']);
            }
          }
        }

        $hargaInventarisByTahun = 'Rp ' . convert($hargaInventarisByTahun);
        // dd($Desember);

        
        $currentTahunDiagram = date("Y");
        for ($i=1; $i <= 10; $i++) { 
            $hargaInventarisByTahunDiagram = 0;
            $listYears[] = (int)$currentTahunDiagram;

            foreach ($datainventaris as $key => $value) {
                $date = strtotime($value->created_at);
                if (date("Y", $date) == $currentTahunDiagram) {
                  $hargaInventarisByTahunDiagram += RemoveSpecialChar($value['harga_satuan']);
                }
            }

            $listTotalHargaPerYears[] = $hargaInventarisByTahunDiagram;

            $currentTahunDiagram-=1;
        }

        $listTotalHargaPerYears = array_reverse($listTotalHargaPerYears);
        $listYears = array_reverse($listYears);

        return view('laporan-inventaris.index', compact('jumlahinventaris',
        'kondisiInventarisBaik',
        'kondisiInventarisRusakRingan',
        'kondisiInventarisRusakBerat',
        'totalBarangPinjam',
        'totalBarangTidakPinjam',
        'hargatotal',
        'currentTahun',
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
        'hargaInventarisByTahun',
        'listTotalHargaPerYears',
        'listYears'));
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
