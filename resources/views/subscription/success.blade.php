@extends('layouts.front')

@section('content')
    <div class="container" >
        <div class="row">

            <div class="col-md-6 col-md-offset-3 form-registration">
                @if(session('invoice') == 'created' || session('online_payment') == 'success')
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Uw inschrijving is succesvol geregistreerd. Gelieve uw e-mail te controleren voor een confirmatie e-mail.
                        Bij vragen kan u ons steeds contacteren. <a href="{{url('/#contact')}}">Meer info</a>
                    </div>
                @endif
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <h4>Overzicht inschrijvingsgegevens</h4>

                        <div class="col-md-12 form-group">
                            <h5>Accountgegevens</h5>



                            <div class="row">
                                <p>Gebruiker</p>
                                <div class="col-md-6">{{$user->firstname}}</div>
                                <div class="col-md-6">{{$user->lastname}}</div>
                            </div>
                            <div class="row">
                                <p>Contactgegevens</p>
                                <div class="col-md-6">{{$user->email}}</div>
                                <div class="col-md-6">{{$user->phone}}</div>
                            </div>
                            <div class="row">
                                <p>Adres</p>
                                <div class="col-md-4">{{$user->street}}</div>
                                <div class="col-md-2">{{$user->street_number}}</div>
                                <div class="col-md-2">{{$user->street_bus_number}}</div>
                                <div class="col-md-1">{{$user->zipcode}}</div>
                                <div class="col-md-3">{{$user->city}}</div>
                            </div>
                            <div class="row">
                                <p>Bedrijf</p>
                                <div class="col-md-6">{{$business->name}}</div>
                                <div class="col-md-6">{{$business->vat}}</div>
                            </div>
                            <div class="row">
                                <p>Adres</p>
                                <div class="col-md-4">{{$business->street}}</div>
                                <div class="col-md-2">{{$business->street_number}}</div>
                                <div class="col-md-2">{{$business->street_bus_number}}</div>
                                <div class="col-md-1">{{$business->zipcode}}</div>
                                <div class="col-md-3">{{$business->city}}</div>
                            </div>
                        </div>

                        <div class="col-md-12 form-group">
                            <h5>Abonnement</h5>
                            <div class="row">
                                <div class="col-md-2">{{$role->display_name}}</div>
                                <div class="col-md-10">{{$role->discription}}</div>
                            </div>
                            @if(isset($payment))
                            <div class="row">
                                <p>Betalingsgegevens</p>
                                <div class="col-md-3">{{$payment->payment_option}}</div>
                                <div class="col-md-3">{{$payment->amount}} €</div>
                                @if($payment->frequency == 12)
                                    <div class="col-md-3">Maandelijkse factuur</div>
                                @endif
                                @if($payment->frequency == 4)
                                    <div class="col-md-3">Kwartaal factuur</div>
                                @endif
                                @if($payment->frequency == 1)
                                    <div class="col-md-3">Jaarlijkse factuur</div>
                                @endif
                            </div>
                                @endif
                        </div>

                        <div class="col-md-12 form-group">

                            <button  onClick="window.print()" class="btn btn-default">
                                Print
                            </button>
                            <a href="{{url('/login')}}" class="pull-right btn btn-primary">Login</a>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection