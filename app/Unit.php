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
}
