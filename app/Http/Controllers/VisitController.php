<?php

namespace App\Http\Controllers;

use App\Client;
use App\Visit;
use App\Item;
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

    public function show(Request $request,$visit_code)
    {
        $visit= Visit::select('*')->where('visit_code','=',$visit_code)->get();
        $items = Item::select('*')->where('visit_code','=',$visit_code)->get();

        $date = Carbon::parse($visit[0]->created_at)->format('d/m/Y');


        return view('app.visits.index',[
            'client_id' => $request->client_id,
            'visit'=>$visit[0],
            'items'=>$items,
            'date'=>$date,
        ]);
    }


    public function destroy(Request $request)
    {
        

        $visit_code = $request->visit_code;
        $visit= Visit::select('*')->where('visit_code','=',$visit_code);

        $visit->delete();

        $items = Item::select('*')->where('visit_code','=',$visit_code);
        $items->delete();

    }

}
