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
		$prev_month = floor($months);
		$next_month = ceil($months);

		$prev_date = $start_date_prev->addMonths($prev_month);
		$next_date = $start_date_next->addMonths($next_month);

		$query = 'select clients.id, clients.firstname, clients.lastname,clients.created_at
                  from clients
                  inner join client_user on client_user.client_id = clients.id
                  where client_user.user_id='.$user_id. ' and clients.created_at >="'. $prev_date.'" and clients.created_at < "'.$next_date.'"';

		$clients = DB::select(DB::Raw($query));



		$amount = (count($clients)/10)*100;

		return view('app.index',[
			'amount'=>$amount
		]);

	}

	public function index_admin()
	{

	}
}
