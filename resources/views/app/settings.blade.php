@extends('layouts.app')

@section('content')
    {{--Abonnement--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Abonnement</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12 form-group">
                            <label for="dateSubscription" class=control-label">Einde abonnement - {{$dateSubscription}}</label>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="dateSubscription" class=control-label">Formule</label>
                            <div class="col-md-12">
                                <div>{{$role->display_name}}</div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label  class="control-label">Betalingsmethode</label>
                            <div class="col-md-12">
                                {{$payment->payment_option}}
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label  class="control-label">Bedrag</label>
                            <div class="col-md-12">
                                {{$payment->amount}}
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="frequency" class="control-label">Facturatie periode</label>
                            <div class="col-md-12">
                                @if($payment->frequency == 0)
                                    <div>Gratis</div>
                                @endif
                                @if($payment->frequency  == 12)
                                    <div>Maandelijks</div>
                                @endif
                                @if($payment->frequency  == 4)
                                    <div>Kwartaal</div>
                                @endif
                                @if($payment->frequency  == 1)
                                   <div>Jaarbasis</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Gebruiker--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right" style="padding-top: 5px;">
                            <a class="btn btn-default" id="edit-settings-user">Aanpassen</a>
                        </div>
                        <h4>Gebruiker</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST" action="{{ url('/settings/update/user/'.$user->id) }}">
                            {{ csrf_field() }}

                            <div class="col-md-6 form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-3control-label">Voornaam</label>
                                <input id="firstname" type="text" class="form-control user" name="firstname" value="{{$user->firstname}}" disabled required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-3control-label">Achternaam</label>
                                <input id="lastname" type="text" class="form-control user" name="lastname" value="{{$user->lastname}}" disabled required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=control-label">E-Mail</label>

                                <input id="email" type="email" class="form-control user" name="email" value="{{$user->email}}" disabled required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-3control-label">Straat</label>
                                <input id="street" type="text" class="form-control user" name="street" value="{{$user->street}}" disabled required>

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                <label for="street_number" class="col-md-3control-label">Nummer</label>
                                <input id="street_number" type="text" class="form-control user" name="street_number" value="{{$user->street_number}}" disabled required>

                                @if ($errors->has('street_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_bus_number') ? ' has-error' : '' }}">
                                <label for="street_bus_number" class="col-md-3control-label">Bus</label>
                                <input id="street_bus_number" type="text" class="form-control user" name="street_bus_number" value="{{$user->street_bus_number}}" disabled>

                                @if ($errors->has('street_bus_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-3control-label">Postcode</label>
                                <input id="zipcode" type="text" class="form-control user" name="zipcode"  required value="{{$user->zipcode}}" disabled required>

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-3control-label">Woonplaats</label>
                                <input id="city" type="text" class="form-control user" name="city" value="{{$user->city}}" disabled>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3control-label">Telefoon</label>
                                <input id="phone" type="text" class="form-control user" name="phone" value="{{$user->phone}}" disabled required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">

                                <button type="submit" id="update-settings-user" class="pull-right btn btn-success" disabled>
                                    Update
                                </button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right" style="padding-top: 5px;">
                            <a class="btn btn-default" id="edit-settings-business">Aanpassen</a>
                        </div>
                        <h4>Bedrijf</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST" action="{{ url('/settings/update/business/'.$business->id) }}">
                            {{ csrf_field() }}
                            <div class="col-md-12 form-group">
                            <label for="business" class=control-label">Bedrijfsnaam</label>
                            <input id="business" type="text" class="form-control business" name="business" value="{{$business->name}}" disabled required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="vat" class=control-label">BTW-nummer</label>
                            <input id="vat" type="text" class="form-control business" name="vat" value="{{$business->vat}}" disabled required>
                        </div>

                        <div class="col-md-6 form-group{{ $errors->has('b_street') ? ' has-error' : '' }}">
                            <label for="b_street" class="col-md-3 control-label">Straat</label>
                            <input id="b_street" type="text" class="form-control business" name="b_street" value="{{$business->street}}" disabled>

                            @if ($errors->has('street'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('b_street') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-3 form-group{{ $errors->has('b_street_number') ? ' has-error' : '' }}">
                            <label for="b_street_number" class="col-md-3control-label">Nummer</label>
                            <input id="b_street_number" type="text" class="form-control business" name="b_street_number" value="{{$business->street_number}}" disabled>

                            @if ($errors->has('b_street_number'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('b_street_number') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-3 form-group{{ $errors->has('b_street_bus_number') ? ' has-error' : '' }}">
                            <label for="b_street_bus_number" class="col-md-3control-label">Bus</label>
                            <input id="b_street_bus_number" type="text" class="form-control business" name="b_street_bus_number" value="{{$business->street_bus_number}}" disabled>

                            @if ($errors->has('street_bus_number'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('b_zipcode') ? ' has-error' : '' }}">
                            <label for="b_zipcode" class="col-md-3control-label">Postcode</label>
                            <input id="b_zipcode" type="text" class="form-control business" name="b_zipcode" value="{{$business->zipcode}}" disabled required>

                            @if ($errors->has('b_zipcode'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('b_zipcode') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('b_city') ? ' has-error' : '' }}" >
                            <label for="b_city" class="col-md-3 control-label">Plaats</label>
                            <input id="b_city" type="text" class="form-control business" name="b_city"  value="{{$business->city}}" disabled>

                            @if ($errors->has('b_city'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('b_city') }}</strong>
                                    </span>
                            @endif
                        </div>
                            <div class="col-md-12 form-group">

                                <button type="submit" id="update-settings-business" class="pull-right btn btn-success" disabled>
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

