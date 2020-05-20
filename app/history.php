<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class History extends Model
{

    protected $table = 'history';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }

    public function room()
    {
        return $this->belongsTo('App\Room_details');
    }
}
