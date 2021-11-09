<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\DataAset;

class DataAsetExport implements FromQuery, WithHeadings, WithColumnFormatting
{
    use Exportable;

    protected $unit,$kondisi,$koderuangan,$ruangan,$kodebarang,$nup;

    public function __construct($unit,$kondisi,$koderuangan,$tahunpengadaan,$kodebarang,$nup)
    {
        $this->unit = $unit;
        $this->kondisi = $kondisi;
        $this->koderuangan = $koderuangan;
        $this->tahunpengadaan = $tahunpengadaan;
        $this->kodebarang = $kodebarang;
        $this->nup = $nup;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function query()
    {
        $data_aset = DataAset::query()->select([
            'nama_barang',
            'kode',
            'nup',
            'uraian_barang',
            'harga_satuan',
            'harga_total',
            'nilai_tagihan',
            'tanggal_SP2D',
            'nomor_SP2D',
            'kelompok_belanja',
            'asal_perolehan',
            'nomor_bukti_perolehan',
            'merk',
            'sumber_dana',
            'pic',
            'kode_ruangan',
            'kondisi',
            'unit',
            'gedung',
            'tahun_pengadaan',
            'ruangan',
            'catatan'
        ]);
        if ($this->unit != null) {
            $data_aset->where('unit', $this->unit);
        }
        if ($this->kondisi != null) {
            $data_aset->where('kondisi', $this->kondisi);
        }
        if ($this->koderuangan != null) {
            $data_aset->where('kode_ruangan', $this->koderuangan);
        }
        if ($this->ruangan != null) {
            $data_aset->where('tahun_pengadaan', $this->tahunpengadaan);
        }
        if ($this->kodebarang != null) {
            $data_aset->where('kode', $this->kodebarang);
        }
        if ($this->nup != null) {
            $data_aset->where('nup', $this->nup);
        }

        return $data_aset;
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Kode Barang',
            'NUP',
            'Uraian Barang',
            'Harga Satuan',
            'Harga Total',
            'Nilai Tagihan',
            'Tanggal SP2D',
            'Nomor SP2D',
            'Kelompok Belanja',
            'Asal Perolehan',
            'Nomor Bukti Perolehan',
            'Merk',
            'Sumber Dana',
            'PIC',
            'Kode Ruangan',
            'Kondisi',
            'Unit',
            'Gedung',
            'Tahun Pengadaan',
            'Ruangan',
            'Catatan'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}
