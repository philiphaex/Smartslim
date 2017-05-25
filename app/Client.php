<?php

namespace App;

use App\User;
use App\Visit;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'firstname', 'lastname', 'birthdate','sex','email', 'street','street_number','street_bus_number','zipcode','phone','mobile','length','weight','physical_activity','target_id','info'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
