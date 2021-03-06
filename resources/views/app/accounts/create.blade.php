@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-registration" >
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <h4>Registratie</h4>
                        <form class="form" role="form" method="POST" action="{{ url('accounts') }}">
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

                            <div class="col-md-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=control-label">E-Mail</label>

                                <input id="email" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Paswoord</label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
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
                                <label for="city" class="col-md-3control-label">Woonplaats</label>
                                <input id="city" type="text" class="form-control" name="city"  required>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
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

                            <div class="col-md-12 form-group">
                                <label for="subscription" class="control-label">Formule</label>
                                <select id="subscription" name="subscription" class="form-control">
                                    <option value="4">Starter</option>
                                    <option value="3">Basis</option>
                                    <option value="2">Professioneel</option>
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
                                <select id="frequency" name="frequency" class="form-control">
                                    <option value="0">Gratis</option>
                                    <option value="1">Maandelijks</option>
                                    <option value="3">Kwartaal</option>
                                    <option value="12">Jaarbasis</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="business" class=control-label">Bedrijfsnaam</label>
                                <input id="business" type="text" class="form-control" name="business" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="vat" class=control-label">BTW-nummer</label>
                                <input id="vat" type="text" class="form-control" name="vat" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label><input type="checkbox" name="address_business"> De adresgegevens van de geregistreerde gebruiker komen overeen met de locatie van het bedrijf</label>
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('b_street') ? ' has-error' : '' }}">
                                <label for="b_street" class="col-md-3 control-label">Straat</label>
                                <input id="b_street" type="text" class="form-control" name="b_street">

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('b_street_number') ? ' has-error' : '' }}">
                                <label for="b_street_number" class="col-md-3control-label">Nummer</label>
                                <input id="b_street_number" type="text" class="form-control" name="b_street_number">

                                @if ($errors->has('b_street_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_street_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('b_street_bus_number') ? ' has-error' : '' }}">
                                <label for="b_street_bus_number" class="col-md-3control-label">Bus</label>
                                <input id="b_street_bus_number" type="text" class="form-control" name="b_street_bus_number">

                                @if ($errors->has('street_bus_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_bus_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('b_zipcode') ? ' has-error' : '' }}">
                                <label for="b_zipcode" class="col-md-3control-label">Postcode</label>
                                <input id="b_zipcode" type="text" class="form-control" name="b_zipcode">

                                @if ($errors->has('b_zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('b_city') ? ' has-error' : '' }}">
                                <label for="b_city" class="col-md-3 control-label">Plaats</label>
                                <input id="b_city" type="text" class="form-control" name="b_city">

                                @if ($errors->has('b_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_city') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-12 form-group">
                                <a href="{{url('/')}}" class="btn btn-default">Annuleer</a>

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