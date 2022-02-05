<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerify extends Model
{
  public $table = 'email_verify';
  protected $fillable = [
      'email',
      'token'
  ];
}
