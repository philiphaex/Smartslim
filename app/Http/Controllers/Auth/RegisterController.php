<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades;
use Illuminate\Http\Request;
use DB;
use Session;
use Mail;
use App\User;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/app';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'street' => 'required|max:255',
            'street_number' => 'required|max:10',
            'street_bus_number' => 'max:10',
            'zipcode' => 'required|max:4',
            'phone' => 'required|max:10',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'street_bus_number' => $data['street_bus_number'],
            'zipcode' => $data['zipcode'],
            'phone' => $data['phone'],
            'confirmation_code' => str_random(30),
        ]);


    }

//    origin: https://github.com/lubusIN/laravel-email-verification-app-boilerplate/blob/master/app/Http/Controllers/Auth/RegisterController.php
    public function register(Request $request)
    {
        // Laravel validation
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }
        // Using database transactions is useful here because stuff happening is actually a transaction
        // I don't know what I said in the last line! Weird!
        DB::beginTransaction();
        try
        {
            $user = $this->create($request->all());
            // After creating the user send an email with the random token generated in the create method above
            $email = new EmailVerification(new User(['confirmation_code' => $user->confirmation_code, 'firstname' => $user->firstname]));
            Mail::to($user->email)->send($email);
            DB::commit();
            Session::flash('message', 'Een bevestigings-email werd verstuurd');
//            return back();
            return redirect('subscription');
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back();
        }
    }

    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('confirmation_code',$token)->firstOrFail()->verified();
        return redirect('login');
    }

    public function showSubscribeForm()
    {
        return view('auth.subscribe');
    }


}
