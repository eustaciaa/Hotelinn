<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    public function alamat(){
        return $this->hasMany('App\alamat');
    }

    public function provinsi(){
        return $this->belongsTo('App\Provinsi');
    }
}

