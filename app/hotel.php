<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hotel extends Model
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
        return $this->hasOne('App\alamat');
    }
}
