<?php

namespace App\Http\Controllers;

use App\Client;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function create($client_id)
    {
        $client = Client::find($client_id);
        $today = Carbon::now();
        $date = Carbon::parse($today)->format('d/m/Y');
        return view('app.visits.create',[
            'client'=>$client,
            'today'=>$date,
        ]);
    }
}
