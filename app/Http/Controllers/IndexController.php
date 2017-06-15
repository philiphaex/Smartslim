<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{
	public function index()
	{
		return view('index.index');
    }

	public function contact(Request $request)
	{
		Log::info($request);

		$name = $request->contactName;
		$email = $request->contactMail;
		$message = $request->contactMessage;

		Log::info($name);
		Log::info($email);
		Log::info($message);


		$to = 'philip.haex@gmail.com';

		Mail::send('emails.contact', ['name' => $name, 'email'=>$email, 'text' => $message], function ($m) use ($to) {
			$m->from('philip.haex@gmail.com', 'Smartslim');

			$m->to($to)->subject('Contactvraag SmartSlim');
		});
		
	}
}
