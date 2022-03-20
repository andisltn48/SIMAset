<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogImportPengajuan extends Model
{
    public $table = 'log_import_pengajuan';
    protected $fillable = [
        'user_id',
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
