<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
	public function send(Request $request)
	{
		$data=[];
		Mail::send('emails.verification', $data, function($message) {
			$message->to('philip_haex@hotmail.com','philip')
				->subject('Verify your email address');
		});

		return response()->json('succes');
    }
}
