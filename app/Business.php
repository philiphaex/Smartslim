<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
//        return $this->hasMany(User::class);

    }
}
