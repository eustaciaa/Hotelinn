<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    protected $table = 'provinsi';

    public function alamat(){
        return $this->hasMany('App\alamat');
    }

    public function kota(){
        return $this->hasMany('App\kota');
    }
}
