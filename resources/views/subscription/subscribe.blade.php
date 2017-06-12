@extends('layouts.front')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-registration">
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <h4>Inschrijving</h4>
                        <form class="form" role="form" method="POST" action="{{ url('subscribe/payment') }}">
                            {{ csrf_field() }}

                            <div class="col-md-12 form-group">
                                <label for="subscription" class="control-label">Formule</label>
                                <select id="subscription" name="subscription" class="form-control">
                                    <option value="4">Starter</option>
                                    <option value="3">Basis</option>
                                    <option value="2">Professioneel</option>
                                </select>

                            </div>

                            <div class="col-md-12 form-group">
                                <h5>Samenvatting van gekozen optie</h5>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="paymentOptions" class="control-label">Betalingsmethode</label>
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label for="paymentOptions-0">
                                            <input type="radio" name="checkboxes" id="paymentOptions-0" value="invoice">
                                            Facturatie
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="paymentOptions-1">
                                            <input type="radio" name="checkboxes" id="paymentOptions-1" value="bank">
                                            Online betaling
                                        </label>
                                    </div>
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
                                <a href="{{url('/')}}" class="btn btn-default">Annuleer</a>

                                <button  class="pull-right btn btn-primary">
                                    Volgende
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection