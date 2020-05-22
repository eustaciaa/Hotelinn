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

    public function kota()
    {
        return $this->belongsTo('App\Kota');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi');
    }

}
