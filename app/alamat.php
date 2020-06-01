<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alamat extends Model
{
    protected $fillable = [
        'provinsi', 'kota', 'detailLengkap'
    ];

    protected $table = 'alamat';

    public function hotel()
    {
        return $this->belongsTo('App\hotel');
    }

    public function hotel_trashed()
    {
        return $this->belongsTo('App\hotel')->withTrashed();
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
