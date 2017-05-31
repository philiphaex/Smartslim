<?php

namespace App\Http\Controllers;

use App\TargetType;
use App\Client;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $targets = TargetType::all();

        return view('app.clients.create',[
            'targets'=>$targets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $client = new Client;

        $login = str_random(5);
        $password = bcrypt(str_random(5));

        $client_id= $client->create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'birthdate' => $request->get('birthdate'),
            'sex' => $request->get('sex'),
            'email' =>$request->get('email'),
            'phone' => $request->get('phone'),
            'street' => $request->get('street'),
            'street_number' => $request->get('street_number'),
            'street_bus_number' => $request->get('street_bus_number'),
            'zipcode' => $request->get('zipcode'),
            'length' => $request->get('length'),
            'weight' => $request->get('weight'),
            'target_id' => $request->get('target_id'),
            'activity' =>$request->get('activity'),
            'info' => $request->get('info'),
            'login'=>$login,
            'password'=>$password,
        ])->id;


        $id = Auth::id();
        $user = User::find($id);
        $user->clients()->attach($client_id);


      /*  return view('app.clients.profile',
            ['client'=>$client]);*/
        return redirect('clients/'.$client_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $target = TargetType::find($client->target_id)->first();

        return view('app.clients.profile',
            ['client'=>$client,
             'target'=>$target->name,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
