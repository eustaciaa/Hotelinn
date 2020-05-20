<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hotel';

    protected $fillable = [
        'name', 'rate', 'photo', 'review'
    ];

    public function alamat()
    {
        return $this->hasOne('App\Alamat');
    }

    public function room()
    {
        return $this->hasMany('App\Room_details');
    }

    public function fasilitas(){
        return $this->hasMany('App\Fasilitas');
    }
}
