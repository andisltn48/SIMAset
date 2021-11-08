<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatAktivitas extends Model
{
    public $table = 'riwayat_aktivitas';
    protected $fillable = [
        'nama_user',
        'aktivitasi'
    ];
}
