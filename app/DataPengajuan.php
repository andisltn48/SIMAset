<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPengajuan extends Model
{
    public $table = 'data_pengajuan';
    protected $fillable = [
        'id_pengaju',
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
        'foto',
        'ruangan',
        'catatan',
        'status_pengajuan',
        'no_pengajuan'
    ];

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }
    
    public function getHargaSatuanAttribute($value)
    {
        return strrev(implode('.', str_split(strrev(strval($value)), 3)));
    }
    public function getHargaTotalAttribute($value)
    {
        return strrev(implode('.', str_split(strrev(strval($value)), 3)));
    }
    public function getNilaiTagihanAttribute($value)
    {
        return strrev(implode('.', str_split(strrev(strval($value)), 3)));
    }
}
