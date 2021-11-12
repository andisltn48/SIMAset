<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListBarangPinjam extends Model
{
    public $table = 'list_barang_pinjam';
    protected $fillable = [
        'no_peminjaman',
        'id_barang',
        'nama_barang',
        'kode_barang',
        'nup_barang',
        'kondisi'
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