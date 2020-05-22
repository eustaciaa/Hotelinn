<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasiitas';

    public function hotel(){
        return $this->belongsToMany('App\Hotel');
    }
}
