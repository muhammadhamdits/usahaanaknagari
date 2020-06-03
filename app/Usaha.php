<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $table = 'usaha';
    protected $guarded = [];

    public function jenis(){
        return $this->belongsTo('App\JenisUsaha', 'jenis_usaha_id', 'id');
    }
}
