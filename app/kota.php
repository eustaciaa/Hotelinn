<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    protected $table = 'kota';

    public function alamat(){
        return $this->hasMany('App\alamat');
    }

    public function provinsi(){
        return $this->belongsTo('App\Provinsi');
    }
}

