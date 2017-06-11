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
            $data[$i]['confirmation'] = $dietician->confirmed;
            $data[$i]['dateOfPayment'] = $dateOfPayment;
            $data[$i]['payment'] = $payment[0]->status;
            $data[$i]['dueDate'] = Carbon::parse($dueDate)->format('d/m/Y');;
            $i++;
        }
//        dd($data);
        return view('app.orders.index',[
            'users'=>$data,
        ]);
    }
}
