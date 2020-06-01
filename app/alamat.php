<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alamat extends Model
{
    protected $fillable = [
       'hotel_id','provinsi_id', 'kota_id', 'detailLengkap'
    ];

    protected $table = 'alamat';

    public function hotel()
    {
        return $this->belongsTo('App\hotel','hotel_id','id');
    }

    public function kota()
    {
        return $this->belongsTo('App\kota');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\provinsi');
    }

}
