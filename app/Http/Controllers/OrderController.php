<?php

namespace App\Http\Controllers;

use App\Business;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        //Alle diëtisten worden opgehaald
        //Voor elke diëtist wordt de laatste betaling opgehaald
        //Deze info wordt doorgegeven aan de view

        $query = 'SELECT * FROM users
        inner join role_user on role_user.user_id = users.id
        inner join roles on roles.id = role_user.role_id
        where roles.name = "dietician"';

        $dieticians = DB::select(DB::Raw($query));


        $i = 0;
        $data = [];
        foreach ($dieticians as $dietician){
            $user_id = $dietician->user_id;
            $business = Business::where('user_id','=',$user_id)->get();
            $payment = Payment::where('user_id','=',$user_id)
                ->orderby('created_at','desc')
                ->get();
            $date = $payment[0]->created_at;
            $dateOfPayment = Carbon::parse($date)->format('d/m/Y');
            $dueDate =  $date->addDays(30);
            $data[$i]['id'] =  $user_id;
            $data[$i]['firstname'] =  $dietician->firstname;
            $data[$i]['lastname'] =  $dietician->lastname;
            $data[$i]['business'] = $business[0]->name;
            $data[$i]['paymentType'] = $payment[0]->payment_option;
            $data[$i]['dateOfPayment'] = $dateOfPayment;
            $data[$i]['paymentStatus'] = $payment[0]->status;
            $data[$i]['dueDate'] = Carbon::parse($dueDate)->format('d/m/Y');
            $data[$i]['payment_id'] = $payment[0]->id;
            $i++;
        }

        return view('app.orders.index',[
            'users'=>$data,
        ]);
    }

    public function confirm(Request $request)
    {
        //Ajax order confirmatie
        //Order krijgt status completed

        $payment_id = $request->payment_id;
        $query = Payment::where('id','=',$payment_id)->get();
        $payment = $query[0];
        $payment_status = DB::table('payment_status')->select('*')->where('name','=','completed')->get();
        $payment->status = $payment_status[0]->id;
        $payment->save();
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        $user = User::find($payment->user_id);
        $status = DB::table('payment_status')->get();

        return view('app.orders.edit',[
           'payment'=>$payment,
            'user'=>$user,
            'stats'=>$status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->payment_option = $request->payment_option;
        $payment->frequency = $request->frequency;
        $payment->amount = $request->amount;
        $payment->dateSubscription = $request->dateSubscription;
        $payment->status = $request->status;
        $payment->save();

        return redirect('/orders');
    }
}
