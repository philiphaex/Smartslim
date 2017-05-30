<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientUser extends Model
{
	protected $fillable = [
		'client_id','user_id',
	];
}
