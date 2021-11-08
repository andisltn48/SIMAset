<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogImport extends Model
{
    public $table = 'log_import';
    protected $fillable = [
        'total',
        'failed',
        'success'
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
