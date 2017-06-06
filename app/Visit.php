<?php

namespace App;

use App\Client;
use App\Item;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'client_id','weight','info','visit_code','created_at','updated_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
