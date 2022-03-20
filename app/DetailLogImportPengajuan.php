<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailLogImportPengajuan extends Model
{
    public $table = 'detail_log_import_pengajuan';
    protected $fillable = [
        'row',
        'nama',
        'status',
        'message',
        'import_id'
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
