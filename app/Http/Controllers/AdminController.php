<?php

namespace App\Http\Controllers;

use App\TargetType;
use App\Client;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('admin.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $user = new User;

        $user =$user->create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'street' => $request->street,
            'street_number' => $request->street_number,
            'street_bus_number' => $request->street_bus_number,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        $role = DB::table('roles')->select('id')->where('name','=','admin')->get();

        $user->attachRole($role[0]->id);
        $user->confirmed = 1;
        $user->save();

        return redirect('/');

    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $query ='SELECT * FROM users
                    inner join role_user on users.id = role_user.user_id
                    where role_user.role_id = 5 and users.confirmed=0';
            $data =DB::select(DB::Raw($query));
            $unconfirmed = count($data);


            $query ='SELECT * FROM homestead.users
                    inner join role_user on users.id = role_user.user_id
                    inner join payments on users.id = payments.user_id
                    where role_user.role_id = 5 and payments.status=1;';
            $data =DB::select(DB::Raw($query));
            $open_payments = count($data);

            $query = 'SELECT * FROM homestead.users
            inner join role_user on users.id = role_user.user_id
            inner join payments on users.id = payments.user_id
            where role_user.role_id = 5
            order by users.created_at desc
            limit 10';

            $users = DB::select(DB::Raw($query));
//            dd($users);
            return view('app.admin.index',[
                'unconfirmed'=>$unconfirmed,
                'open_payments'=>$open_payments,
                'users'=>$users,
            ]);

        }
    }


}
