<?php

namespace App;

use App\Price;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //
    public function price()
    {
        return $this->hasOne(Price::class);
    }
}
