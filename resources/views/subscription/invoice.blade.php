@extends('layouts.front')

@section('content')
    {{--Facturatie--}}
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2 form-registration">
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <h4>Facturatie</h4>
                        <form class="form" role="form" method="POST" action="{{ url('invoice') }}">
                            {{ csrf_field() }}

                        @unless($price->price == 0)
                                <div class="col-md-12 form-group">
                                    <label for="frequency" class="control-label">Facturatie periode</label>
                                    <select id="frequency" name="frequency" class="form-control">
                                        @if($price->price == 0)
                                            <option value="0">Gratis</option>
                                        @endif
                                        <option value="1">Maandelijks</option>
                                        <option value="3">Kwartaal</option>
                                        <option value="12">Jaarbasis</option>
                                    </select>
                                </div>
                            @endunless
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
                            <div class="col-md-6 form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-3control-label">Straat</label>
                                <input id="street" type="text" class="form-control" name="street">

                                @if ($errors->has('street'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                <label for="street_number" class="col-md-3control-label">Nummer</label>
                                <input id="street_number" type="text" class="form-control" name="street_number">

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
                                <input id="zipcode" type="text" class="form-control" name="zipcode">

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-3control-label">Stad</label>
                                <input id="city" type="text" class="form-control" name="city">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 form-group">
                                <label><input type="checkbox" name="paymentconditions" required> Ik accepteer de <a href="{{url('/')}}">betalingscondities</a></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <a href="{{url('/')}}" class="btn btn-default">Annuleer</a>

                                <button  class="pull-right btn btn-success">
                                    Valideren
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 form-registration">
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <h4>Inschrijvingsinformatie</h4>
                        <p>U heeft gekozen voor {{$sub->display_name}}  </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection