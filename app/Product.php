<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sku', 'cost',
    ];
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    public function reservation_item()
    {
        return $this->hasMany('App\ReservationItem');
    }
}
