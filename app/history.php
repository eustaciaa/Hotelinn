<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class history extends Model
{

    protected $table = 'history';

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function hotel()
    {
        return $this->belongsTo('App\hotel');
    }

    public function room()
    {
        return $this->belongsTo('App\room_details');
    }
}
