<?php

namespace App;

use App\Role;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function role()
    {
        return $this->belongsTo(Role::class);

    }
}
