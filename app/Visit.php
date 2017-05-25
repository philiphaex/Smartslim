<?php

namespace App;

use App\Client;
use App\Event;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
