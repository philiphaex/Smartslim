<?php

namespace App\Http\Controllers;

use App\Business;
use App\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {

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
//            dd($dateOfPayment);
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
        $payment_id = $request->payment_id;
        $query = Payment::where('id','=',$payment_id)->get();
        $payment = $query[0];
        $payment_status = DB::table('payment_status')->select('*')->where('name','=','completed')->get();
        $payment->status = $payment_status[0]->id;
        $payment->save();
    }
}
