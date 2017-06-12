@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="padding-top: 5px;">
                        <a href="{{url('clients/'.$client->id.'/edit')}}" class="btn btn-default">Gegevens updaten</a>
                        <a href="{{url('clients/'.$client->id.'/visits/create')}}" class="btn btn-primary">Voeg bezoek toe</a>
                    </div>
                    <h4 >Profiel - {{$client->lastname}} {{$client->firstname}}</h4>
                </div>


        </div>
        <div class="row" id="profile-data">

            <div class="col-md-6">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        Basisgegevens
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">BMI</label>
                                <div >
                                    @php
                                        echo round(($client->weight)/($client->length*$client->length)*10000,1);
                                    @endphp
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Gewicht</label>
                                <div >
                                    {{$client->weight}} kg
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Leeftijd</label>
                                <div >
                                    @php
                                        $dob=$client->birthdate;
                                        $diff = (date('Y') - date('Y',strtotime($dob)));
                                        echo $diff.' jaar';
                                    @endphp
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Geslacht</label>
                                <div >
                                    {{$client->sex}}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label class="control-label">Doel</label>
                                <div >
                                    {{$target}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Activiteitsgraad</label>
                                <div >
                                    {{$client->activity}}
                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        Contactgegevens
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Telefoonnr</label>
                                <div >
                                    {{$client->phone}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Email</label>
                                <div >
                                    {{$client->email}}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12 form-group">
                                <label class="control-label">Woonplaats</label>
                                <div >
                                    {{$client->street}}
                                    {{$client->street_number}}
                                    {{$client->street_bus_number}}
                                    {{$client->zipcode}}
                                    {{--{{$city}}--}}
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        Extra info
                    </div>
                    <div class="panel-body">
                        <textarea class="col-md-12 form-control" disabled>{{$client->info}}</textarea>

                    </div>




                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('app.visits.list')
            </div>
        </div>
    </div>
@endsection