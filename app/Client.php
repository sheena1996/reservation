<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // 
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'address', 'contact_number'
    ];
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
