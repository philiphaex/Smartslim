@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row">
            @php
            var_dump($targets[0]->name);
            @endphp
            <div class="col-md-8 col-md-offset-2" >
                <div class="panel panel-default" >
                    <div class="panel panel-heading">
                        <h4>Cliënt Registratie</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST" action="{{ url('clients') }}">
                            {{ csrf_field() }}
                            <h4>Basis gegevens</h4>
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
                                <label for="sex" class="control-label">Geslacht</label>
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="sex-0">
                                            <input type="radio" name="sex" id="sex-0" value="male">
                                            Man
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="sex-1">
                                            <input type="radio" name="sex" id="sex-1" value="female">
                                            Vrouw
                                        </label>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="radio">
                                            <label for="sex-2">
                                                <input type="radio" name="sex" id="sex-2" value="other">
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
                            <h4>Fysische gegevens</h4>
                            <div class="col-md-6 form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                                <label for="length" class="col-md-3control-label">Lengte</label>
                                <input id="length" type="text" class="form-control" name="length"  required>

                                @if ($errors->has('length'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('length') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-3control-label">Gewicht</label>
                                <input id="weight" type="text" class="form-control" name="weight"  required>

                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <h4>Dieet gegevens</h4>
                            <div class="col-md-6 form-group">
                                <label for="target" class="control-label">Doel</label>
                                <select id="target" name="target_id" class="form-control">
                                    @foreach ($targets as $target)
                                        <option value="{{$target->id}}">{{$target->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                                <label for="activity" class="col-md-3control-label">Bewegingsgraad</label>
                                <input id="activity" type="text" class="form-control" name="activity">

                                @if ($errors->has('activity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <h4>Extra Info</h4>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="info"></textarea>
                                </div>
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