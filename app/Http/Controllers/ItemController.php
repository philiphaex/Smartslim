<?php

namespace App\Http\Controllers;

use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //


    public function store(Request $request, $visit_code)
    {

        $item = new Item;

        $item->create([
            'visit_code'=>$visit_code,
            'title'=>$request->get('title'),
            'input'=>$request->get('input'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

    }

    public function showList($visit_code)
    {
        $data = Item::select('*')->where('visit_code','=',$visit_code)->get();

        if ($data != null) {
            return response()->json([$data]);
        }
    }

}
