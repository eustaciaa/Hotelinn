<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_description extends Model
{
    protected $table = 'room_description';

    public function room_details(){
        return $this->belongsToMany('App\Room_details');
    }
}
