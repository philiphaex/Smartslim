<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
	public function index_dietician()
	{
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
				  'order by clients.created_at desc';

		$clients = DB::select(DB::Raw($query));


		$amount = count($clients);
		$query= 'SELECT permissions.display_name
				 FROM homestead.permissions
				 inner join permission_role on permission_role.permission_id = permissions.id
				 inner join role_user on role_user.role_id = permission_role.role_id
				 where role_user.user_id='.$user_id;
		$limit =DB::select(DB::Raw($query));
		$percent = ($amount/ $limit[0]->display_name)*100;

		return view('app.dashboard.index',[
			'clients' => $clients,
			'amount' =>$amount,
			'percent'=>$percent,
			'limit'=> $limit[0]->display_name,
		]);
		
	}

	public function index_admin()
	{

	}

	public function settings()
	{
		return view ('app.settings');
	}
}
