<?php

namespace App\Http\Controllers;

use App\TargetType;
use App\Client;
use App\User;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('admin.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $user = new User;

        $user =$user->create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'street' => $request->street,
            'street_number' => $request->street_number,
            'street_bus_number' => $request->street_bus_number,
            'zipcode' => $request->zipcode,
            'phone' => $request->phone,
            'confirmed' => true,
        ]);

        $role = DB::table('roles')->select('id')->where('name','=','admin')->get();

        $user->attachRole($role[0]->id);

        return redirect('login');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

//        $visits = Visit::select('*')->where('client_id','=',$id)->get();
        $visits = Visit::orderby('created_at','dsc')->where('client_id','=',$id)->get();



        return view('app.clients.profile',
            ['client'=>$client,
                'target'=>$target->name,
                'visits'=>$visits,

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
        $client = Client::findOrFail($id);

        $targets = TargetType::all();
        $city = DB::table('zipcodes')->select('Gemeente')->where('zipcode','=',$client->zipcode)->get();

        return view('app.clients.edit',[
            'client'=>$client,
            'targets'=>$targets,
            'city'=>$city[0]->Gemeente,
        ]);
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
        $client = Client::findOrFail($id);
        $client->fill(Input::all());
        $client->save();

        return redirect('clients/'.$client->id);
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

    public function search(Request $request)
    {
        if ($request->ajax()){
            $output = "";
         $keyword = $request->get('keyword');
    /*     $clients = Client::where('lastname','LIKE','%'.$keyword.'%')
             ->orWhere('firstname','LIKE','%'.$keyword.'%')
             ->orderby('lastname','asc')
             ->orderby('firstname','asc')
             ->get();*/

            $clients = Client::where(DB::raw('CONCAT_WS(" ", lastname, firstname)'),'like','%'.$keyword.'%')
                ->orderby('lastname','asc')
                ->orderby('firstname','asc')
                ->get();



            if (count($clients)>0)
            {
                foreach ($clients as $client){



                    $output .= '<tr id="client-'.$client->id.'">'.
                    '<td class="table-text">'.
                    '<div>'.$client->firstname.'</div>'.
                    '</td>'.
                    '<td class="table-text">'.
                    '<div>'.$client->lastname.'</div>'.
                    '</td>'.
                    '<td class="table-text">'.
                    '<div>'.$this->getLastVisit($client).'</div>'.
                    '</td>'.
                    '<td class="table-text">'.
                    '<a href="clients/'.$client->id .'" class="btn btn-success"> <i class="fa fa-check-circle-o"></i></a>'.
                     '</td>'.
                    '</tr>';


                }
                return response($output);
            }else{
                $output = '<div>Er werd geen overeenkomstige cliënt gevonden</div>';
                return response($output);

            }


        }
    }

    public function getLastVisit($client)
    {
        $visited = Visit::select('*')->where('client_id','=',$client->id)->get();
        if ($visited->count() >0 ){
            $query = 'select visits.created_at
                      from visits
                      where visits.client_id='.$client->id.
                ' order by visits.created_at desc 
                      limit 1';

            $visit_date = DB::select(DB::Raw($query));
            $date = Carbon::parse( $visit_date[0]->created_at)->format('d/m/Y');
        }else{
            $date='Nog geen bezoek';
        }

        return $client->visit=$date;
    }
}
