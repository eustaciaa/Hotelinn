<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class room_details extends Model
{
    protected $table = 'room_details';

    use SoftDeletes;

    public function hotel()
    {
        return $this->belongsTo('App\hotel');
    }


}
