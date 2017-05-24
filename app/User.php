<?php

namespace App;

use App\Business;
use App\Payment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password','street','street_number','street_bus_number','zipcode','phone','mobile','confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        $this->confirmed= 1;
        $this->confirmation_code = null;

        $this->save();
    }
    public function business()
    {
        return $this->hasOne(Business::class);
//        return $this->belongsTo(Business::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
