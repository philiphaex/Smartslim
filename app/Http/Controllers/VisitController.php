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

        $visit_code = str_random(15);


        return view('app.visits.create',[
            'client'=>$client,
            'today'=>$date,
            'visit_code'=>$visit_code,
        ]);
    }

    public function store(Request $request, $client_id)
    {
        $visit = new Visit;

        $visit->create([
            'client_id'=>$client_id,
            'weight'=>$request->weight,
            'info'=>$request->info,
            'visit_code'=>$request->visit_code,
        ]);

        return redirect('clients/'.$client_id);

    }
}
