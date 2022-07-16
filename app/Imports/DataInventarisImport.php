<?php

namespace App\Imports;

use App\DataInventaris;
use App\DetailLogImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DataInventarisImport implements ToModel,WithValidation , WithHeadingRow, SkipsEmptyRows, SkipsOnFailure, SkipsOnError, WithCalculatedFormulas
{
    protected $id_import;
    use Importable, SkipsFailures, SkipsErrors;
    public function __construct($id_import)
    {
        $this->id_import = $id_import;
    }

    public function model(array $row)
    {
        if ($row["jumlah"] > 1) {
            $current_nup = $row["nup_awal"];
            $last_nup = 0;

            for ($i=0; $i < $row["jumlah"]; $i++) {
                $last_nup = $current_nup + $i;
            }

            for ($current_nup; $current_nup <= $last_nup ; $current_nup++) {
                $test_nup = DataInventaris::where('kode',$row["kode_barang"])->where('nup', $current_nup)->get();
                // dd($test_nup->count());
                if ($test_nup->count()  == 0 ) {

                    $success = DetailLogImport::create([
                        'row' => $row["no"],
                        'nama' => $row["nama_barang"],
                        'status' => 'Success',
                        'message' => 'Berhasil ditambahkan ( Kode : '.$row["kode_barang"].' NUP :'.$current_nup.')',
                        'import_id' => $this->id_import
                    ]);

                    DataInventaris::create([
                        'nama_barang' => $row["nama_barang"],
                        'kode' => $row['kode_barang'],
                        'nup' => $current_nup,
                        'uraian_barang' => $row['uraian_barang_menurut_kode'],
                        'jumlah' => $row['jumlah'],
                        'harga_satuan' => $row['harga_satuan'],
                        'harga_total' => $row['total'],
                        'nilai_tagihan' => $row['nilai_tagihan'],
                        'tanggal_SP2D' => date('d-m-Y H:i:s', strtotime($row['tanggal_sp2d'])),
                        'nomor_SP2D' => $row['nomor_sp2d'],
                        'kelompok_belanja' => $row['kelompok_belanja'],
                        'asal_perolehan' => $row['asal_perolehan_perusahaan_kota'],
                        'nomor_bukti_perolehan' => $row['no_bukti_perolehan_kontrak_spm'],
                        'merk' =>$row['merk_spesifikasi_barang'] ,
                        'sumber_dana' => $row["sumber_dana"],
                        'pic' => $row["pic"],
                        'kode_ruangan' => $row['kode_ruang'],
                        'kondisi' => $row['kondisi_barang'],
                        'unit' => $row['unit_rumpun'],
                        'status' => 'Aktif',
                        'gedung' => $row['gedung'],
                        'tahun_pengadaan' => $row['tahun_pengadaan'],
                        'ruangan' => $row['ruangan'],
                        'catatan' => $row['catatan'],
                    ]);
                }
                else {
                    $failed = DetailLogImport::create([
                        'row' => $row["no"],
                        'nama' => $row["nama_barang"],
                        'status' => 'Failed',
                        'message' => 'Barang dengan nup : '.$current_nup.' dan kode barang : '.$row["kode_barang"].' sudah terdaftar',
                        'import_id' => $this->id_import
                    ]);
                }

            }
        }
         else {
            $test_nup = DataInventaris::where('kode',$row["kode_barang"])->where('nup', $row["nup_awal"])->get();
                // dd($test_nup->count());
                if ($test_nup->count()  == 0 ) {

                    $success = DetailLogImport::create([
                        'row' => $row["no"],
                        'nama' => $row["nama_barang"],
                        'status' => 'Success',
                        'message' => 'Berhasil ditambahkan ( Kode : '.$row["kode_barang"].' NUP :'.$row["nup_awal"].')',
                        'import_id' => $this->id_import
                    ]);

                    DataInventaris::create([
                        'nama_barang' => $row["nama_barang"],
                        'kode' => $row['kode_barang'],
                        'nup' => $row["nup_awal"],
                        'uraian_barang' => $row['uraian_barang_menurut_kode'],
                        'jumlah' => $row['jumlah'],
                        'harga_satuan' => $row['harga_satuan'],
                        'harga_total' => $row['total'],
                        'nilai_tagihan' => $row['nilai_tagihan'],
                        'tanggal_SP2D' => date('d-m-Y H:i:s', strtotime($row['tanggal_sp2d'])),
                        'nomor_SP2D' => $row['nomor_sp2d'],
                        'kelompok_belanja' => $row['kelompok_belanja'],
                        'asal_perolehan' => $row['asal_perolehan_perusahaan_kota'],
                        'nomor_bukti_perolehan' => $row['no_bukti_perolehan_kontrak_spm'],
                        'merk' =>$row['merk_spesifikasi_barang'] ,
                        'sumber_dana' => $row["sumber_dana"],
                        'pic' => $row["pic"],
                        'kode_ruangan' => $row['kode_ruang'],
                        'kondisi' => $row['kondisi_barang'],
                        'unit' => $row['unit_rumpun'],
                        'status' => 'Aktif',
                        'gedung' => $row['gedung'],
                        'tahun_pengadaan' => $row['tahun_pengadaan'],
                        'ruangan' => $row['ruangan'],
                        'catatan' => $row['catatan'],
                    ]);
                }
                else {
                    $failed = DetailLogImport::create([
                        'row' => $row["no"],
                        'nama' => $row["nama_barang"],
                        'status' => 'Failed',
                        'message' => 'Barang dengan nup : '.$row["nup_awal"].' dan kode barang : '.$row["kode_barang"].' sudah terdaftar',
                        'import_id' => $this->id_import
                    ]);
                }
        }

    }

    public function headingRow(): int
    {
        return 4;
    }

    public function rules(): array
    {

        return [
            "*.nama_barang" => ['required'],
            "*.kode_barang" => ['required', 'numeric'],
            "*.nup_awal" => ['required'],
            "*.uraian_barang_menurut_kode" => ['required'],
            "*.jumlah" => ['required', 'numeric'],
            "*.harga_satuan" => ['required'],
            "*.total" => ['required'],
            "*.nilai_tagihan" => ['required'],
            "*.tanggal_sp2d" => ['required'],
            "*.nomor_sp2d" => ['required', 'numeric'],
            "*.kelompok_belanja" => ['required'],
            "*.asal_perolehan_perusahaan_kota" => ['required'],
            "*.no_bukti_perolehan_kontrak_spm" => ['required'],
            "*.merk_spesifikasi_barang" => ['required'],
            "*.sumber_dana" => ['required'],
            "*.pic" => ['required'],
            "*.kondisi_barang"=>['required'],
            "*.unit_rumpun" => ['required'],
            "*.tahun_pengadaan" => ['required']
        ];
    }
}
