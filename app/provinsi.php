<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    public function alamat(){
        return $this->hasMany('App\alamat');
    }
}
