@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{--Main title--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="padding-top: 5px;">
                        <a href="{{url('accounts')}}" class="btn btn-default">Terug</a>
                        <a href="{{url('accounts/'.$user->id.'/edit')}}" class="btn btn-default">Gegevens updaten</a>
                    </div>
                    <h4 >Account - {{$user->lastname}} {{$user->firstname}}</h4>
                </div>


            </div>
            {{--User info--}}
            <div class="row">
                {{--User info--}}
                <div class="col-md-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Gebruikergegevens
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Voornaam</label>
                                    <div>
                                        {{$user->firstname}}
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Achternaam</label>
                                    <div>
                                        {{$user->lastname}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label class="control-label">E-mail adres</label>
                                    <div>
                                        {{$user->email}}
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Telefoonnummer</label>
                                    <div>
                                        {{$user->phone}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Straat</label>
                                    <div>
                                        {{$user->street}}
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Nummer</label>
                                    <div>
                                        {{$user->street_number}}
                                    </div>
                                </div>
                                @if( $user->street_bus_number != null)
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Bus</label>
                                        <div>
                                            {{$user->street_bus_number}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label class="control-label">Postcode</label>
                                    <div>
                                        {{$user->zipcode}}
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Woonplaats</label>
                                    <div>
                                        {{$user->city}}
                                    </div>
                                </div>
                            </div>





                        </div>
                    </div>
                </div>
                {{--Business info--}}
                <div class="col-md-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Bedrijfsgegevens
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Naam</label>
                                    <div>
                                        {{$business->name}}
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">BTW-nummer</label>
                                    <div>
                                        {{$business->vat}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Straat</label>
                                    <div>
                                        {{$business->street}}
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Nummer</label>
                                    <div>
                                        {{$business->street_number}}
                                    </div>
                                </div>
                                @if( $business->street_bus_number != null)
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Bus</label>
                                        <div>
                                            {{$business->street_bus_number}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label class="control-label">Postcode</label>
                                    <div>
                                        {{$business->zipcode}}
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Plaats</label>
                                    <div>
                                        {{$business->city}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--Acount info--}}
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Account info
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Aantal cliënten</label>
                                    <div>
                                        @php
                                            echo count($clients);
                                        @endphp
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Abonnementsformule</label>
                                    <div>
                                        {{$role}}
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">Einde abonnement</label>
                                    <div>
                                        @php
                                        $dt = strtotime($payments[0]->dateSubscription);
                                        echo date('d-m-Y',$dt);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--overview payments--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Betalingen
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                <th>Datum</th>
                                <th>Status</th>
                                <th>Betalingswijze</th>
                                <th>Bedrag</th>

                                </thead>

                                <!-- Table Body -->
                                <tbody id="payment-list">
                                @foreach ($payments as $payment)
                                    <tr id="payment-{{$payment->id}}">

                                        <td class="table-text">
                                            <div>{{ $payment->created_at }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{  $payment->status }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{  $payment->payment_option }}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{  $payment->amount }} euro</div>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




@endsection