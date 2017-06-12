<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use App\Business;
use App\Payment;
use App\Price;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = 'SELECT * FROM users
        inner join role_user on role_user.user_id = users.id
        inner join roles on roles.id = role_user.role_id
        where roles.name = "dietician"';

        $dieticians = DB::select(DB::Raw($query));

        $unconfirmed = 0;
        $i = 0;
        $data = [];
        foreach ($dieticians as $dietician){
            $user_id = $dietician->user_id;
            $user = User::find($user_id);
            $dateOfRegistration = Carbon::parse($user->created_at)->format('d/m/Y');

            $business = Business::where('user_id','=',$user_id)->get();

            $query = 'select clients.id, clients.firstname, clients.lastname
                      from clients
                      inner join client_user on client_user.client_id = clients.id
                       where client_user.user_id='.$user_id;

            $clients = DB::select(DB::Raw($query));

            $query = 'SELECT * FROM homestead.roles
                      inner join role_user on role_user.role_id = roles.id
                      where role_user.user_id ='.$user_id;

            $role =DB::select(DB::Raw($query));
            $data[$i]['id'] =  $user_id;
            $data[$i]['date'] =  $dateOfRegistration;
            $data[$i]['firstname'] =  $dietician->firstname;
            $data[$i]['lastname'] =  $dietician->firstname;
            $data[$i]['business'] =  $business[0]->name;
            $data[$i]['role'] =  $role[0]->display_name;
            $data[$i]['clients'] =  count($clients);
            $data[$i]['confirmed'] =  $dietician->confirmed;

            if($dietician->confirmed == 0 ){
                $unconfirmed++;
            }
            $i++;
        }


        return view('app.accounts.index',[
            'unconfirmed' => $unconfirmed,
            'users'=>$data,
        ]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('app.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //User registration
        $user = new User;
        $user_id = $user->create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'street' => $request->street,
            'street_number' => $request->street_number,
            'street_bus_number' => $request->street_bus_number,
            'zipcode' => $request->zipcode,
            'phone' =>$request->phone,
            'confirmed'=>1,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ])->id;
        $role_id = $request->subscription;

        $user = User::where('id', '=', $user_id)->first();
        $user->attachRole($role_id);
        $user->attachRole(5); //dietician role

        //Business registration
        $business = new Business;
        $business->user_id = $user_id;
        $business->name = $request->business;
        $business->vat = $request->vat;
        $business->paymentconditions = true;
        if ($request->address_business == 'on'){
            $business->street = $user->street;
            $business->street_number = $user->street_number;
            $business->street_bus_number = $user->street_bus_number;
            $business->zipcode = $user->zipcode;
        }else{
            $business->street = $request->b_street;
            $business->street_number = $request->b_street_number;
            $business->street_bus_number = $request->b_street_bus_number;
            $business->zipcode = $request->b_zipcode;
        }
        $business->save();


        //Payment order maken
        $price_info = Price::where('role_id','=',$role_id)->get();
        $price = $price_info[0]->price;

        //payment registratie
        //Amount on invoice
        $amount = $price * $request->frequency;
        //Number of invoices on year basis
        if($price>0){

            $frequency =   12 / $request->frequency;
        }else{
            $frequency = 0;
        }

        $payment = new Payment;
        $payment->user_id = $user_id;
        $payment->payment_option = 'invoice';
        $payment->amount = $amount;
        $payment->frequency = $frequency;
        $payment->status = 1;

        $payment->save();

        return redirect ('accounts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirm(Request $request)
    {
        //Ajax account confirmatie
        //Account krijgt status confirme

        $user_id = $request->user_id;
        $query = User::where('id','=',$user_id)->get();
        $user = $query[0];
        $user->confirmed = 1;
        $user->save();
    }
}
