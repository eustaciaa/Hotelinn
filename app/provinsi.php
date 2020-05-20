<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';

    public function alamat(){
        return $this->hasMany('App\Alamat');
    }

    public function kota(){
        return $this->hasMany('App\Kota');
    }
}
