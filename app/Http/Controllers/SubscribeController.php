<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Price;
use App\Business;
use App\Payment;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    //
    public function index()
    {
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
                'sub'=>$subscription,
                'price'=>$price_info,

            ]);
        }
        
    }

    public function invoice(Request $request)
    {
        //debug
//        dd($request->all());
        //Attaching role to user
        $user_id=session('user_id');
        $role_id=session('role_id');
        $user = User::where('id', '=', $user_id)->first();
        $user->attachRole($role_id);

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
        $amount = $price * $request->frequency;
        //Number of invoices on year basis
        $frequency =   12 / $request->frequency;

        $payment = new Payment;
        $payment->user_id = $user_id;
        $payment->payment_option = 'invoice';
        $payment->amount = $amount;
        $payment->frequency = $frequency;
        $payment->status = 0;

        $payment->save();

        return view('subscription.success');

    }
    public function banktransfer(Request $request){


        $payment = Mollie::api()->payments()->create([
            "amount"      => 10.00,
            "description" => "My first API payment",
            "redirectUrl" => "http://smartslim.dev/",
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);

        if ($payment->isPaid())
        {
            echo "Payment received.";
        }
    }
}
