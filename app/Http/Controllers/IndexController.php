<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Response;
use Cookie;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{
	public function index()
	{
		return view('index.index');
    }

	public function contact(Request $request)
	{

		$name = $request->contactName;
		$email = $request->contactMail;
		$message = $request->contactMessage;

		$to = 'philip.haex@gmail.com';

		Mail::send('emails.contact', ['name' => $name, 'email'=>$email, 'text' => $message], function ($m) use ($to) {
			$m->from('philip.haex@gmail.com', 'Smartslim');

			$m->to($to)->subject('Contactvraag SmartSlim');
		});
		
	}

	public function acceptCookie()
	{
		$time = 43200;
		$cookie = cookie('smartslim', 'visited', $time);

		return response('cookie set')->cookie($cookie);

	}
}
