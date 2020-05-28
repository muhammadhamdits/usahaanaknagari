<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = "admin";
    protected $primaryKey = 'id';
    public $incrementing=false;
    use Notifiable;

    protected $fillable = [
        'username','password',
    ];

    protected $hidden = [
      'password','remember_token',
    ];
}
