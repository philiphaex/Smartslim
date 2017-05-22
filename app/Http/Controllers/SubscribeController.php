<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Price;
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

        $user_id=session('user_id');
        $role_id = $request->get('subscription');

        $user = User::where('id', '=', $user_id)->first();
        $user->attachRole($role_id);

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

    public function invoicing(Request $request)
    {

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
