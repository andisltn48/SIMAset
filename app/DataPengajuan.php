<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengajuan extends Model
{
    public $table = 'data_pengajuan';
    protected $fillable = [
        'nama_barang',
        'kode',
        'nup',
        'uraian_barang',
        'jumlah',
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
        'status_pengajuan',
        'gedung',
        'tahun_pengadaan',
        'ruangan',
        'catatan'
    ];

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }
}
