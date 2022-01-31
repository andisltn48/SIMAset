<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivitasSistem extends Model
{
    public $table = 'aktivitas_sistem';
    protected $fillable = [
        'user_id',
        'user_activity',
        'user_role',
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
