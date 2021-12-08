<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRuangan extends Model
{
  public $table = 'data_ruangan';
  protected $fillable = [
      'kode_ruangan',
      'nama_ruangan',
      'pj',
      'nip',
      'kode_gedung'
  ];
}
