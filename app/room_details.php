<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class room_details extends Model
{
    protected $table = 'room_details';

    public function hotel()
    {
        return $this->belongsTo('App\hotel');
    }

    public function hotel_trashed()
    {
        return $this->belongsTo('App\hotel')->withTrashed();
    }

}
