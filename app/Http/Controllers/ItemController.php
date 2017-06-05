<?php

namespace App\Http\Controllers;

use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //


    public function store(Request $request)
    {

        $item = new Item;

        $item_id = $item->create([
            'visit_code'=>$request->visit_code,
            'title'=>$request->title,
            'input'=>$request->input,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ])->id;

        $data = Item::select('*')->where('id','=',$item_id)->get();

        if ($data != null) {
           return $data;
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $data= Item::select('*')->where('id','=',$id)->get();
        $item= Item::select('*')->where('id','=',$id);
        $item->delete();

        if ($data != null) {
            return $data;
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $item= Item::select('*')->where('id','=',$id);
        $item->delete();

        
    }

}
