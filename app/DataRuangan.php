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

  public function getUpdatedAtAttribute($value)
  {
      return date('d-m-Y H:i:s', strtotime($value));
  }
  public function getCreatedAtAttribute($value)
  {
      return date('d-m-Y H:i:s', strtotime($value));
  }
}
