<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hotel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    use SoftDeletes;

    protected $table = 'hotel';

    protected $fillable = [
        'name', 'rating', 'photo', 'reviewers', 'star'
    ];

    public function alamat()
    {
        return $this->hasOne('App\alamat');
    }

    public function room()
    {
        return $this->hasMany('App\room_details');
    }

    public function fasilitas()
    {
        return $this->hasMany('App\Fasilitas');
    }
}
