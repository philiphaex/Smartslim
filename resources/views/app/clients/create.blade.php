@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default" >
                    <div class="panel panel-heading">
                        <h4>Cliënt Registratie</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST" action="{{ url('clients') }}">
                            {{ csrf_field() }}

                            <div class="col-md-6 form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label for="firstname" class="col-md-3control-label">Voornaam</label>
                                <input id="firstname" type="text" class="form-control" name="firstname"  required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-3control-label">Achternaam</label>
                                <input id="lastname" type="text" class="form-control" name="lastname"  required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                <label for="birthdate" class="col-md-3control-label">Geboortedatum</label>
                                <input id="birthdate" type="date" class="form-control" name="birthdate"  required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="paymentOptions" class="control-label">Geslacht</label>
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="paymentOptions-0">
                                            <input type="radio" name="checkboxes" id="sex-0" value="male">
                                            Man
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="paymentOptions-1">
                                            <input type="radio" name="checkboxes" id="sex-1" value="female">
                                            Vrouw
                                        </label>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label for="paymentOptions-1">
                                                <input type="radio" name="checkboxes" id="sex-2" value="other">
                                                Anders
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=control-label">E-Mail</label>

                                <input id="email" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3control-label">Telefoon</label>
                                <input id="phone" type="text" class="form-control" name="phone"  required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-3control-label">Straat</label>
                                <input id="street" type="text" class="form-control" name="street"  required>

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                <label for="street_number" class="col-md-3control-label">Nummer</label>
                                <input id="street_number" type="text" class="form-control" name="street_number"  required>

                                @if ($errors->has('street_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_bus_number') ? ' has-error' : '' }}">
                                <label for="street_bus_number" class="col-md-3control-label">Bus</label>
                                <input id="street_bus_number" type="text" class="form-control" name="street_bus_number">

                                @if ($errors->has('street_bus_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-3control-label">Postcode</label>
                                <input id="zipcode" type="text" class="form-control" name="zipcode"  required>

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-3control-label">Stad</label>
                                <input id="city" type="text" class="form-control" name="city"  required>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>





                            <div class="col-md-12 form-group">
                                <a href="{{url('clients')}}" class="btn btn-default">Annuleer</a>

                                <button  class="pull-right btn btn-success">
                                    Registreer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection