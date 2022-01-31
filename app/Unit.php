<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $table = 'units';
    protected $fillable = [
        'nama_unit',
        'kode_unit'
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
