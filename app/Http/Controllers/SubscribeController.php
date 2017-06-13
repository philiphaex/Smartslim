<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Price;
use App\Business;
use App\Payment;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    //
    public function index()
    {
//        session()->forget('invoice');
        return view('subscription.subscribe');

    }

    public function subscribe(Request $request)
    {
        $subscription = $request->get('subscription');
        $payment_option = $request->get('checkboxes');

        $subscription_info = Role::find($subscription);
        $price_info = Price::where('role_id','=',$subscription)->first();

        session(['role_id' => $subscription]);


        if ($payment_option == 'invoice'){
            return view('subscription.invoice',[
                'sub'=>$subscription_info,
                'price'=>$price_info,
            ]);
        }
        if ($payment_option == 'bank'){
            return view('subscription.bank',[
                'sub'=>$subscription_info,
                'price'=>$price_info,

            ]);
        }

    }

    public function invoice(Request $request)
    {


        //Attaching role to user
        $user_id=session('user_id');
        $role_id=session('role_id');
        $user = User::where('id', '=', $user_id)->first();
        $roles = DB::table('role_user')->select('*')->where('user_id','=',$user_id)->get();

        

        if(!isset($roles[0])){
            $user->attachRole($role_id);
            //'dietician' role toevoegen
            $user->attachRole(5);
        }



        //Business registration
        $business = new Business;
        $business->user_id = $user_id;
        $business->name = $request->business;
        $business->vat = $request->vat;
        if ($request->paymentconditions == 'on'){
            $business->paymentconditions = true;
        }

        if ($request->address_business == 'on'){
            $business->street = $user->street;
            $business->street_number = $user->street_number;
            $business->street_bus_number = $user->street_bus_number;
            $business->zipcode = $user->zipcode;
        }else{
            $business->street = $request->street;
            $business->street_number = $request->street_number;
            $business->street_bus_number = $request->street_bus_number;
            $business->zipcode = $request->zipcode;
        }
        $business->save();

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

        $role = Role::find($role_id);


        session(['invoice' => 'created']);
        session(['user' => $user]);
        session(['business' => $business]);
        session(['role' => $role]);
        session(['payment' => $payment]);


            return view('subscription.success', [
                'user'=>$user,
                'business'=>$business,
                'role'=>$role,
                'payment'=>$payment,
            ]);



    }
    public function banktransfer(Request $request){
        //Attaching role to user
        $user_id=session('user_id');
        $role_id=session('role_id');
        $user = User::where('id', '=', $user_id)->first();
        $user->attachRole($role_id);
        $user->attachRole(5);

        //Business registration
        $business = new Business;
        $business->user_id = $user_id;
        $business->name = $request->business;
        $business->vat = $request->vat;
        if ($request->paymentconditions == 'on'){
            $business->paymentconditions = true;
        }

        if ($request->address_business == 'on'){
            $business->street = $user->street;
            $business->street_number = $user->street_number;
            $business->street_bus_number = $user->street_bus_number;
            $business->zipcode = $user->zipcode;
        }else{
            $business->street = $request->street;
            $business->street_number = $request->street_number;
            $business->street_bus_number = $request->street_bus_number;
            $business->zipcode = $request->zipcode;
        }
        $business->save();

        $price_info = Price::where('role_id','=',$role_id)->first();
        $price = $price_info->price;

        //payment registratie
        //Amount on invoice

        //Number of invoices on year basis
        $amount = $price * 12;
        $payment = new Payment;
        $payment->user_id = $user_id;
        $payment->payment_option = 'online_payment';
        $payment->amount = $amount;
        $payment->frequency = 1;
        $payment->status = 0;
        $payment->save();


        $role = Role::find($role_id);


        session(['user' => $user]);
        session(['business' => $business]);
        session(['role' => $role]);
        session(['payment' => $payment]);

       $pay_mollie = Mollie::api()->payments()->create([
            "amount"      => $amount,
            "description" => "Inschrijving SmartSlim",
            "redirectUrl" =>  'http://6a9e08d6.ngrok.io'.'/banktransfer/complete/'.$payment->id,
           "webhookUrl" =>   'http://6a9e08d6.ngrok.io'.'/banktransfer/success',
           "metadata"=> array(
               'order_id' => $payment->id),
        ]);

        $payment->mollie_id = $pay_mollie->id;
        $payment->save();

        return redirect(Mollie::api()->payments()->get($pay_mollie->id)->getPaymentUrl());


    }

    public function completeInvoice()
    {

        return view('subscription.success', [
            'user'=>session('user'),
            'business'=>session('business'),
            'role'=>session('role'),
            'payment'=>session('payment'),
          ]);
    }

    public function completeBanktransfer($id)
    {

//        $payment_id = Mollie::api()->payments()->get()->id;
        
       /* $mollie_id = Mollie::api()->payments()->get($pay_mollie->id)->id;

        $payment_id =  Mollie::api()->payments()->get($pay_mollie->id)->metadata;
        $status =  Mollie::api()->payments()->get($pay_mollie->id)->status;

        $payment = Payment::where('id','=',$payment_id)->first();
        if($status == 'paid'){
            $payment->status = $mollie_id;
            $payment->save();
        }*/


        $payment = Payment::where('id','=',$id)->first();
        $user_id = $payment->user_id;
        $user = User::where('id','=',$user_id)->first();
        $business = Business::where('user_id','=',$user_id)->first();
        $query= DB::table('role_user')->select('role_id')->where('user_id','=',$user_id)->first();
        $role_id = $query->role_id;
        $role=Role::find($role_id);

        return view('subscription.success',[
            'user'=>$user,
            'business'=>$business,
            'role'=>$role,
            'payment'=>$payment,
        ]);

    }

    public function webhookBanktransfer()
    {

        $mollie_id = $_POST['id'];
        $payment_id =  Mollie::api()->payments()->get($mollie_id)->metadata->order_id;
        $status =  Mollie::api()->payments()->get($mollie_id)->status;




//        Storage::put('test.txt', file_get_contents('php://input'));
//        $mollie_payment_info =  Mollie::api()->payments()->get($mollie_id);
//        Storage::put('test.txt', serialize($mollie_payment_info));

        $payment = Payment::where('id','=',$payment_id)->first();
        if($status == 'paid' && $payment->mollie_id == $payment_id){
            $payment->status = 1;
            $payment->save();
        }

        return http_response_code(200);

    }
}
