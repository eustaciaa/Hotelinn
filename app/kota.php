<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';

    public function alamat(){
        return $this->hasMany('App\Alamat');
    }

    public function provinsi(){
        return $this->belongsTo('App\Provinsi');
    }
}

