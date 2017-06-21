<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use App\Visit;
use App\Payment;
use App\Business;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
	public function index()
	{
       if(Auth::user()->hasRole('dietician')){
		$user_id = Auth::id();
		$start = User::findOrFail($user_id);
		$start_date_prev = $start->created_at;
		$start_date_next = $start->created_at;
		$current_date = Carbon::now();
//		$start_date = Carbon::parse( $start->created_at)->format('d/m/Y');
//		$date = Carbon::now();

//		$current_date = Carbon::parse( $date)->format('d/m/Y');
		$interval = $start_date_prev->diffInDays($current_date);
		$months = $interval/30;
		$modulo = $interval%30;
		if($modulo >0){
			$prev_month = floor($months);
			$next_month = ceil($months);
		}else{
			$prev_month = $months;
			$next_month = $months + 1;
		}

		$prev_date = $start_date_prev->addMonths($prev_month);
		$next_date = $start_date_next->addMonths($next_month);

		$query = 'select clients.id, clients.firstname, clients.lastname,clients.created_at
                  from clients
                  inner join client_user on client_user.client_id = clients.id
                  where client_user.user_id='.$user_id. ' and clients.created_at >="'. $prev_date.'" and clients.created_at < "'.$next_date.'"'.
				  'order by clients.created_at desc limit 5';

		$clients = DB::select(DB::Raw($query));

           $amount = count($clients);
           $query= 'SELECT permissions.display_name
				 FROM homestead.permissions
				 inner join permission_role on permission_role.permission_id = permissions.id
				 inner join role_user on role_user.role_id = permission_role.role_id
				 where role_user.user_id='.$user_id;
		$limit =DB::select(DB::Raw($query));
//           dd($limit);
		$percent = ($amount/ $limit[0]->display_name)*100;

		return view('app.dashboard.index',[
			'clients' => $clients,
			'amount' =>$amount,
			'percent'=>$percent,
			'limit'=> $limit[0]->display_name,
		]);
        }
       /* if(Auth::user()->hasRole('admin')){
            $query ='SELECT * FROM homestead.users
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
            return view('app.dashboard.index',[
                'unconfirmed'=>$unconfirmed,
                'open_payments'=>$open_payments,
                'users'=>$users,
            ]);

       }*/



        }

	public function index_admin()
	{
        return view('app.dashboard.index');
	}

	public function settings()
	{
		$user = Auth::user();
		$id = Auth::id();
		$city = DB::table('zipcodes')->select('gemeente')->where('zipcode','=',$user->zipcode)->get();
		$role_id = DB::table('role_user')->select('*')->where('user_id','=',$id)->get();
		$role = DB::table('roles')->select('*')->where('id','=',$role_id[0]->role_id)->get();
		$payment = Payment::where('user_id','=',$id)->orderby('created_at','desc')->get();
		$business = Business::where('user_id','=',$id)->get();
		$b_city = DB::table('zipcodes')->select('gemeente')->where('zipcode','=',$business[0]->zipcode)->get();
		$dateSubscription = Carbon::parse($payment[0]->dateSubscription)->format('d/m/Y');
        $today = Carbon::now();
		return view ('app.settings',[
			'user'=>$user,
			'city'=>$city[0]->gemeente,
			'b_city'=>$b_city[0]->gemeente,
			'role_id'=>$role_id[0]->role_id,
			'role'=>$role[0],
			'payment'=>$payment[0],
			'business'=>$business[0],
            'today'=>$today,
			'dateSubscription'=>$dateSubscription,

		]);
	}

    public function updateUser(Request $request, $id)
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

        return redirect('/settings');
    }

    public function updateBusiness(Request $request, $id)
    {
        $business = Business::findOrFail($id);

        $business->name = $request->business;
        $business->vat = $request->vat;
        $business->street = $request->b_street;
        $business->street_number = $request->b_street_number;
        $business->street_bus_number = $request->b_street_bus_number;
        $business->zipcode = $request->b_zipcode;
        $business->save();

        return redirect('/settings');
    }


}
