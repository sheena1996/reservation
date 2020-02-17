<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    public function reservation_item()
    {
        return $this->hasMany('App\ReservationItem');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}

