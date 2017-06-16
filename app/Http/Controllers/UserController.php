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

        $overdue = 0;
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

            $payment =Payment::where('user_id','=',$user_id)->orderby('created_at','desc')->get();


            $data[$i]['id'] =  $user_id;
            $data[$i]['date'] =  $dateOfRegistration;
            $data[$i]['firstname'] =  $dietician->firstname;
            $data[$i]['lastname'] =  $dietician->lastname;
            $data[$i]['business'] =  $business[0]->name;
            $data[$i]['role'] =  $role[0]->display_name;
            $data[$i]['clients'] =  count($clients);
            $data[$i]['confirmed'] =  $dietician->confirmed;
            $data[$i]['dateStartSubscription'] =  Carbon::parse($payment[0]->created_at)->format('d/m/Y');
            $data[$i]['dateEndSubscription'] =  Carbon::parse($payment[0]->dateSubscription)->format('d/m/Y');
            $data[$i]['payment_status'] =  $payment[0]->status;

            if($dietician->confirmed == 0 ){
                $unconfirmed++;
            }
            if($payment[0]->status == 5 ){
                $overdue++;
            }
            $i++;
        }


        return view('app.accounts.index',[
            'unconfirmed' => $unconfirmed,
            'overdue' => $overdue,
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
        $user = User::find($id);
        $business = Business::where('user_id','=',$user->id)->get();
        $query = 'select clients.id, clients.firstname, clients.lastname
                      from clients
                      inner join client_user on client_user.client_id = clients.id
                       where client_user.user_id='.$user->id;

        $clients = DB::select(DB::Raw($query));
        $payments = Payment::where('user_id','=',$user->id)->orderby('created_at','desc')->get();

        $zipcode_user =$user->zipcode;
        $zipcode_business = $business[0]->zipcode;

        $city_user = DB::table('zipcodes')->select('Gemeente')->where('zipcode','=',$zipcode_user)->get();
        $city_business = DB::table('zipcodes')->select('Gemeente')->where('zipcode','=',$zipcode_business)->get();

        $query = 'SELECT * FROM homestead.roles
                      inner join role_user on role_user.role_id = roles.id
                      where role_user.user_id ='.$user->id;

        $role =DB::select(DB::Raw($query));

        return view('app.accounts.profile',[
            'user'=>$user,
            'business'=>$business[0],
            'clients'=>$clients,
            'payments'=>$payments,
            'city_user'=>$city_user[0]->Gemeente,
            'city_business'=>$city_business[0]->Gemeente,
            'role'=>$role[0]->display_name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $city = DB::table('zipcodes')->select('gemeente')->where('zipcode','=',$user->zipcode)->get();
        $role_id = DB::table('role_user')->select('*')->where('user_id','=',$id)->get();
//        $role = DB::table('roles')->select('*')->where('id','=',$role_id[0]->role_id)->get();
        $payment = Payment::where('user_id','=',$id)->orderby('created_at','desc')->get();
        $business = Business::where('user_id','=',$id)->get();
        $b_city = DB::table('zipcodes')->select('gemeente')->where('zipcode','=',$business[0]->zipcode)->get();

        $date = Carbon::parse($payment[0]->dateSubscription)->format('d/m/Y');
        return view ('app.accounts.edit',[
            'user'=>$user,
            'city'=>$city[0]->gemeente,
            'b_city'=>$b_city[0]->gemeente,
            'role_id'=>$role_id[0]->role_id,
            'payment'=>$payment[0],
            'business'=>$business[0],
            'dateSubscription'=>$date,

        ]);
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
        $user = User::findOrFail($id);
        $user->firstname = $request->firstname;
         $user->lastname = $request->lastname;
           $user->email = $request->email;
            $user->street = $request->street;
            $user->street_number = $request->street_number;
            $user->street_bus_number = $request->street_bus_number;
            $user->zipcode = $request->zipcode;
            $user->phone= $request->phone;
            $user->updated_at= Carbon::now();
        $user->save();
        $payment = Payment::where('user_id','=',$id)->orderby('created_at','desc')->get();
        $payment[0]->payment_option = 'invoice';
        $payment[0]->frequency = $request->frequency;
        $payment[0]->status = 1;
        $payment[0]->updated_at = Carbon::now();
        $payment[0]->dateSubscription = $request->dateSubscription;
        $price = DB::table('prices')->select('*')->where('role_id','=',$request->subscription)->get();
        $payment[0]->amount = $price[0]->price * $request->frequency;
        $payment[0]->save();

        $business = Business::where('user_id','=',$id)->get();
        $business[0]->name = $request->business;
        $business[0]->vat = $request->vat;
        $business[0]->street = $request->b_street;
        $business[0]->street_number = $request->b_street_number;
        $business[0]->street_bus_number = $request->b_street_bus_number;
        $business[0]->zipcode = $request->zipcode;
        $business[0]->save();

        DB::table('role_user')->select('*')->where('user_id','=',$id)->where('role_id','<','5')->delete();
        $user->attachRole($request->subscription);
        return redirect('accounts/'.$id);
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
