<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPeminjaman extends Model
{
    public $table = 'data_peminjaman';
    protected $fillable = [
        'nama_peminjam',
        'id_peminjam',
        'nama_penanggung_jawab',
        'no_peminjaman',
        'jumlah',
        'tanggal_penggunaan',
        'surat_peminjaman',
        'surat_balasan',
        'data_diri_penanggung_jawab',
        'status_permintaan',
        'status_peminjaman',
        'saran',
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

