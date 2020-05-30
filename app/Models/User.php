<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const validation_rules = [
        'nama' => 'required',
    ];

    protected $table = 'users';

    protected $guarded = [];
}
