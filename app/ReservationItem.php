<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservation_items';

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
