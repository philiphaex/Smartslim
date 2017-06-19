<?php

namespace App;

use App\User;
use App\Visit;
use App\TargetType;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'firstname', 'lastname', 'birthdate','sex','email', 'street','street_number','street_bus_number','zipcode', 'city','phone','mobile','length','weight','activity','target_id','info','login','password',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function target()
    {
        return $this->hasOne(TargetType::class);
    }
}
