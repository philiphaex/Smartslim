<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function credentials(Request $request)
    {

        return [
            'email' => $request->email,
            'password' => $request->password,
            'confirmed' => 1,
        ];
    }

    public function login(Request $request)
    {
        $user = DB::table('users')->select('*')->where('email','=',$request->email)->get();
        if (!isset($user[0])){
            Session::flash('danger','Gebruikersnaam of wachtwoord is incorrect.');
            return back();

        }else{
            $password = Hash::check($request->password, $user[0]->password);
            if(!$password){
                Session::flash('danger','Gebruikersnaam of wachtwoord is incorrect.');
                return back();
            }
        }
            if( ! $user[0]->confirmed)
            {
                Session::flash('unconfirmed','Dit e-mailadres werd nog niet geconfirmeerd. Gelieve uw e-mail na te kijken.');
                return back();
            }

        $credentials =  [
            'email' => $request->email,
            'password' => $request->password,
            'confirmed' => 1,
        ];

        if( Auth::attempt($credentials, true) ){

            Session::put('user', Auth::user());
        }
        Session::flash('success','U werd succesvol ingelogd');
        return redirect('dashboard');
    }

}
