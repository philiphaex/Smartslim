<?php

namespace App;

use App\Visit;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'visit_code','title','input','created_at','updated_at',
    ];
    
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
