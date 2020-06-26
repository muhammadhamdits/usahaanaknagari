<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsulanUpdate extends Model
{
    protected $table = 'usulan_update';
    protected $guarded = [];

    public function usaha(){
        return $this->belongsTo('App\Usaha', 'usaha_id', 'id');
    }

    public function jenis(){
        return $this->belongsTo('App\JenisUsaha', 'jenis_usaha_id', 'id');
    }
}
