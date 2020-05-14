<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\history;

class user extends Model
{
    public function history()
    {
        return $this->hasMany('history');

    }
}
