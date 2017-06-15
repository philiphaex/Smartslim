@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    Betaling - {{$user->firstname}} {{$user->lastname}}
                </div>
                <div class="panel-body">
                <form class="form" role="form" method="POST" action="{{ url('orders/update/'.$payment->id) }}">
                    <div class="col-md-12 form-group">
                        {{ csrf_field() }}


                        <div class="col-md-12 form-group">
                            <label for="payment_option" class="control-label">Betalingswijze</label>
                            <select id="payment_option" name="payment_option" class="form-control">
                                <option value="invoice">Factuur</option>
                                <option value="online_payment">Online betaling</option>
                                <option value="free">Gratis</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="frequency" class="control-label">Facturatie periode</label>
                            <select id="frequency" name="frequency" class="form-control">
                                <option value="1">Jaarbasis</option>
                                <option value="4">Kwartaal</option>
                                <option value="12">Maandelijks</option>
                                <option value="0">Gratis</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="amount" class="col-md-3control-label">Hoeveelheid</label>
                            <input id="amount" type="number" class="form-control" name="amount" value="{{$payment->amount}}" required autofocus>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="dateSubscription" class="col-md-3control-label">Einde abonnement</label>
                            @if(isset($payment->dateSubscription))
                            <input id="dateSubscription" type="date" class="form-control" name="dateSubscription"  required autofocus>
                            @else
                            <input id="dateSubscription" type="date" class="form-control" name="dateSubscription" value="{{$payment->dateSubscription}}"  required autofocus>
                                @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="status" class="control-label">Status</label>
                            <select id="status" name="status" class="form-control">
                                @foreach($stats as $stat)
                                <option value="{{$stat->id}}">{{$stat->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <a href="{{url('/orders')}}" class="btn btn-default">Annuleer</a>

                        <button  class="pull-right btn btn-success">
                            Update
                        </button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>

@endsection