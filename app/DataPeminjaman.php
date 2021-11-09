<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPeminjaman extends Model
{
    public $table = 'data_peminjaman';
    protected $fillable = [
        'nama_peminjam',
        'nama_penanggung_jawab',
        'no_peminjaman',
        'nama_barang',
        'kode_barang',
        'nup_barang',
        'jumlah',
        'kondisi',
        'tanggal_penggunaan',
        'surat_peminjaman',
        'surat_balasan',
        'data_diri_penanggung_jawab',
        'status_peminjaman'
    ];
}
