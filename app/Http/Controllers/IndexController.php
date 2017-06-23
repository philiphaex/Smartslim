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
		return view('index');
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

	public function help(Request $request)
	{
		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$email = $request->email;
		$subject = $request->helpSubject;
		$message = $request->helpMessage;

		$to = 'philip.haex@gmail.com';

		Mail::send('emails.help', ['firstname' => $firstname, 'lastname' => $lastname, 'email'=>$email, 'subject' => $subject, 'text' => $message], function ($m) use ($to) {
			$m->from('philip.haex@gmail.com', 'Smartslim');

			$m->to($to)->subject('Help request');
		});
	}


	public function acceptCookie()
	{
		$time = 43200;
		$cookie = cookie('smartslim', 'visited', $time);

		return response('cookie set')->cookie($cookie);

	}

	public function privacy()
	{
		return view('index.privacypolicy');
	}

}
