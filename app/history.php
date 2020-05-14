<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class history extends Model
{
    public function user()
    {
        return $this->hasOne('user');
    }
}
