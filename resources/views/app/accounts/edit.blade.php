@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default" >
                    <div class="panel panel-heading">
                        <div class="pull-right" style="padding-top: 5px;">
                            <a class="btn btn-default" id="edit-account">Aanpassen</a>
                            <a href="{{url('accounts/'.$user->id)}}" class="btn btn-danger">Annuleren</a>
                        </div>
                        <h4 >Gegevens - {{$user->lastname}} {{$user->firstname}}</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST" action="{{ url('accounts/'.$user->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="col-md-6 form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-3control-label">Voornaam</label>
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{$user->firstname}}" disabled required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-3control-label">Achternaam</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{$user->lastname}}" disabled required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=control-label">E-Mail</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" disabled required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-3control-label">Straat</label>
                                <input id="street" type="text" class="form-control" name="street" value="{{$user->street}}" disabled required>

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                <label for="street_number" class="col-md-3control-label">Nummer</label>
                                <input id="street_number" type="text" class="form-control" name="street_number" value="{{$user->street_number}}" disabled required>

                                @if ($errors->has('street_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_bus_number') ? ' has-error' : '' }}">
                                <label for="street_bus_number" class="col-md-3control-label">Bus</label>
                                <input id="street_bus_number" type="text" class="form-control" name="street_bus_number" value="{{$user->street_bus_number}}" disabled>

                                @if ($errors->has('street_bus_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-3control-label">Postcode</label>
                                <input id="zipcode" type="text" class="form-control" name="zipcode"  required value="{{$user->zipcode}}" disabled required>

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-3control-label">Stad</label>
                                <input id="city" type="text" class="form-control" name="city" value="{{$user->city}}" disabled>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3control-label">Telefoon</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$user->phone}}" disabled required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="subscription" class="control-label">Formule</label>
                                <select id="subscription" name="subscription" class="form-control" disabled>
                                    @if($role_id == 4)
                                        <option value="4" selected>Starter</option>
                                    @else
                                        <option value="4">Starter</option>
                                    @endif
                                    @if($role_id == 3)
                                        <option value="3" selected>Basis</option>
                                    @else
                                        <option value="3">Basis</option>
                                    @endif
                                    @if($role_id == 2)
                                        <option value="2" selected>Professioneel</option>
                                    @else
                                        <option value="2">Professioneel</option>
                                    @endif
                                </select>

                            </div>
                            <div class="col-md-12 form-group">
                                <label  class="control-label">Betalingsmethode</label>
                                <div class="col-md-12">
                                    Facturatie
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="frequency" class="control-label">Facturatie periode</label>
                                <select id="frequency" name="frequency" class="form-control" disabled>
                                    @if($payment->frequency == 0)
                                        <option value="0" selected>Gratis</option>
                                    @else
                                        <option value="0">Gratis</option>
                                    @endif
                                    @if($payment->frequency  == 12)
                                        <option value="12" selected>Maandelijks</option>
                                    @else
                                        <option value="12">Maandelijks</option>
                                    @endif
                                    @if($payment->frequency  == 4)
                                        <option value="4" selected>Kwartaal</option>
                                    @else
                                        <option value="4">Kwartaal</option>
                                    @endif
                                    @if($payment->frequency  == 1)
                                        <option value="1" selected>Jaarbasis</option>
                                    @else
                                        <option value="1">Jaarbasis</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="dateSubscription" class=control-label">Einde abonnement - huidge datum {{$dateSubscription}}</label>
                                <input id="dateSubscription" type="date" class="form-control" name="dateSubscription"  disabled required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="business" class=control-label">Bedrijfsnaam</label>
                                <input id="business" type="text" class="form-control" name="business" value="{{$business->name}}" disabled required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="vat" class=control-label">BTW-nummer</label>
                                <input id="vat" type="text" class="form-control" name="vat" value="{{$business->vat}}" disabled required>
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('b_street') ? ' has-error' : '' }}">
                                <label for="b_street" class="col-md-3 control-label">Straat</label>
                                <input id="b_street" type="text" class="form-control" name="b_street" value="{{$business->street}}" disabled>

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('b_street_number') ? ' has-error' : '' }}">
                                <label for="b_street_number" class="col-md-3control-label">Nummer</label>
                                <input id="b_street_number" type="text" class="form-control" name="b_street_number" value="{{$business->street_number}}" disabled>

                                @if ($errors->has('b_street_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_street_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('b_street_bus_number') ? ' has-error' : '' }}">
                                <label for="b_street_bus_number" class="col-md-3control-label">Bus</label>
                                <input id="b_street_bus_number" type="text" class="form-control" name="b_street_bus_number" value="{{$business->street_bus_number}}" disabled>

                                @if ($errors->has('street_bus_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('b_zipcode') ? ' has-error' : '' }}">
                                <label for="b_zipcode" class="col-md-3control-label">Postcode</label>
                                <input id="b_zipcode" type="text" class="form-control" name="b_zipcode" value="{{$business->zipcode}}" disabled>

                                @if ($errors->has('b_zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('b_city') ? ' has-error' : '' }}">
                                <label for="b_city" class="col-md-3 control-label">Stad</label>
                                <input id="b_city" type="text" class="form-control" name="b_city"  value="{{$business->city}}" disabled>

                                @if ($errors->has('b_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_city') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-12 form-group">

                                <button type="submit" id="update-account" class="pull-right btn btn-success" disabled>
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