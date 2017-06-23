<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Price;
use App\Business;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index()
    {
        return view('subscription.subscribe');

    }

    public function subscribe(Request $request)
    {
        $subscription_id = $request->get('subscription');
        $subscription  = Role::find($subscription_id);
        if($subscription->name == 'level1') {

            $price_info = Price::where('role_id', '=', $subscription_id)->first();

            session(['role_id' => $subscription_id]);
            return view('subscription.free', [
                'sub' => $subscription,
                'price' => $price_info,
            ]);
        }
        $payment_option = $request->get('checkboxes');

        $price_info = Price::where('role_id','=',$subscription_id)->first();

        session(['role_id' => $subscription_id]);


        if ($payment_option == 'invoice'){
            return view('subscription.invoice',[
                'sub'=>$subscription,
                'price'=>$price_info,
            ]);
        }
        if ($payment_option == 'bank'){
            return view('subscription.bank',[
                'sub'=>$subscription,
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
            $business->city = $user->city;
        }else{
            $business->street = $request->street;
            $business->street_number = $request->street_number;
            $business->street_bus_number = $request->street_bus_number;
            $business->zipcode = $request->zipcode;
            $business->city = $request->city;
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

        $date = Carbon::now();
        if($payment->frequency == 1){
            $dt = $date->addYear();
            $payment->dateSubscription =  $dt->toDateTimeString();
            $payment->save();
        }
        if($payment->frequency == 4){
            $dt = $date->addDays(90);
            $payment->dateSubscription =   $dt->toDateTimeString();
            $payment->save();
        }
        if($payment->frequency == 12){
            $dt =  $date->addDays(30);
            $payment->dateSubscription = $dt->toDateTimeString();
            $payment->save();
        }


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
            $business->city = $user->city;
        }else{
            $business->street = $request->street;
            $business->street_number = $request->street_number;
            $business->street_bus_number = $request->street_bus_number;
            $business->zipcode = $request->zipcode;
            $business->city = $request->city;
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
            "redirectUrl" =>  config('app.url').'/banktransfer/complete/'.$payment->id,
           "webhookUrl" =>   config('app.url').'/banktransfer/success',
           "metadata"=> array(
               'order_id' => $payment->id),
        ]);

        $payment->mollie_id = $pay_mollie->id;
        $payment->status = 1;
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
        $payment = Payment::where('id','=',$id)->first();

        if($payment->status == 2){

            $date = Carbon::now();
                $dt = $date->addYear();
                $payment->dateSubscription = $dt->toDateTimeString();
                $payment->save();
           

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
        
        if($payment->status == 3){
            $user_id = $payment->user_id;
            User::where('id','=',$user_id)->delete();
            Business::where('user_id','=',$user_id)->delete();
            DB::table('role_user')->select('role_id')->where('user_id','=',$user_id)->delete();

            return view('subscription.error');
        }
    }

    public function webhookBanktransfer()
    {

        $mollie_id = $_POST['id'];
        $payment_id =  Mollie::api()->payments()->get($mollie_id)->metadata->order_id;
        $status =  Mollie::api()->payments()->get($mollie_id)->status;

        $payment = Payment::where('id','=',$payment_id)->first();
        if($status == 'paid'){
            log::info('werkt');
            $payment->status = 2;
            $payment->save();
        }
        if($status == 'cancelled'){
            $payment->status = 3;
            $payment->save();
        }

        return http_response_code(200);

    }

    public function free(Request $request)
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
        $business->paymentconditions = false;

        if ($request->address_business == 'on'){
            $business->street = $user->street;
            $business->street_number = $user->street_number;
            $business->street_bus_number = $user->street_bus_number;
            $business->zipcode = $user->zipcode;
            $business->city = $user->city;
        }else{
            $business->street = $request->street;
            $business->street_number = $request->street_number;
            $business->street_bus_number = $request->street_bus_number;
            $business->zipcode = $request->zipcode;
            $business->city = $request->city;
        }
        $business->save();


        $role = Role::find($role_id);

        //payment registratie
        $payment = new Payment;
        $payment->user_id = $user_id;
        $payment->payment_option = 'free';
        $payment->amount = 0;
        $payment->frequency = 0;
        $payment->status = 4;

        $date = Carbon::now();
        $dt = $date->addYear();
        $payment->dateSubscription = $dt->toDateTimeString();

        $payment->save();


        session(['invoice' => 'created']);
        session(['user' => $user]);
        session(['business' => $business]);
        session(['role' => $role]);


        return view('subscription.success', [
            'user'=>$user,
            'business'=>$business,
            'role'=>$role,
        ]);
    }
}
