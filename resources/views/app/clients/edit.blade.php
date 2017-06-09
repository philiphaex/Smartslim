@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default" >
                    <div class="panel panel-heading">
                        <div class="pull-right" style="padding-top: 5px;">
                            <a class="btn btn-default" id="edit-profile">Aanpassen</a>
                            <a href="{{url('clients/'.$client->id)}}" class="btn btn-danger">Annuleren</a>
                        </div>
                        <h4 >Gegevens - {{$client->lastname}} {{$client->firstname}}</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST" action="{{ url('clients/'.$client->id) }}">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <h4>Basis gegevens</h4>
                            <div class="col-md-6 form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-3control-label">Voornaam</label>
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{$client->firstname}}" disabled required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-3control-label">Achternaam</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{$client->lastname}}" disabled required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                <label for="birthdate" class="col-md-3control-label">Geboortedatum</label>
                                <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{$client->birthdate}}" disabled required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sex" class="control-label">Geslacht</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label for="sex-0">
                                                @if($client->sex == 'Man')
                                                <input type="radio" name="sex" id="sex-0" value="Man" disabled checked>
                                                @else
                                                <input type="radio" name="sex" id="sex-0" value="Man" disabled>
                                                @endif
                                                Man
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label for="sex-1">
                                                @if($client->sex == 'Vrouw')
                                                <input type="radio" name="sex" id="sex-1" value="Vrouw" checked disabled>
                                                @else
                                                <input type="radio" name="sex" id="sex-1" value="Vrouw" disabled>
                                                @endif
                                                Vrouw
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label for="sex-2">
                                                @if($client->sex == 'Anders')
                                                <input type="radio" name="sex" id="sex-2" value="Anders" checked disabled>
                                                @else
                                                <input type="radio" name="sex" id="sex-2" value="Anders" disabled>
                                                @endif
                                                Anders
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=control-label">E-Mail</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{$client->email}}" disabled required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3control-label">Telefoon</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$client->phone}}" disabled required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-3control-label">Straat</label>
                                <input id="street" type="text" class="form-control" name="street" value="{{$client->street}}" disabled required>

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                <label for="street_number" class="col-md-3control-label">Nummer</label>
                                <input id="street_number" type="text" class="form-control" name="street_number" value="{{$client->street_number}}"disabled required>

                                @if ($errors->has('street_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_bus_number') ? ' has-error' : '' }}">
                                <label for="street_bus_number" class="col-md-3control-label">Bus</label>
                                <input id="street_bus_number" type="text" class="form-control" name="street_bus_number" value="{{$client->street_bus_number}}" disabled>

                                @if ($errors->has('street_bus_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-3control-label">Postcode</label>
                                <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{$client->zipcode}}" disabled  required>

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="city" class="col-md-3control-label">Stad</label>
                                <input id="city" type="text" class="form-control" value="{{$city}}" disabled required>


                            </div>
                            <h4>Fysische gegevens</h4>
                            <div class="col-md-6 form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                                <label for="length" class="col-md-3control-label">Lengte</label>
                                <input id="length" type="text" class="form-control" name="length" value="{{$client->length}}" disabled required>

                                @if ($errors->has('length'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('length') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-3control-label">Gewicht</label>
                                <input id="weight" type="text" class="form-control" name="weight" value="{{$client->weight}}" disabled required>

                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <h4>Dieet gegevens</h4>
                            <div class="col-md-6 form-group">
                                <label for="target" class="control-label">Doel</label>
                                <select id="target" name="target_id" class="form-control" disabled>
                                    @foreach ($targets as $target)
                                        <option value="{{$target->id}}">{{$target->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                                <label for="activity" class="col-md-3control-label">Bewegingsgraad</label>
                                <input id="activity" type="text" class="form-control" name="activity" value="{{$client->activity}}" disabled>

                                @if ($errors->has('activity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <h4>Extra Info</h4>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="info" disabled>{{$client->info}}</textarea>
                                </div>
                            </div>


                            <div class="col-md-12 form-group">

                                <button class="pull-right btn btn-success" id="update-profile" disabled>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection