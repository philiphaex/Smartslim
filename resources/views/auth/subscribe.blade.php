@extends('layouts.front')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-6 col-md-offset-3" id="form-registration">
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <h4>Inschrijving</h4>
                        <form class="form" role="form" method="POST" action="{{ route('subscribe') }}">
                            {{ csrf_field() }}

                            <div class="col-md-12 form-group">
                                <label for="formule" class="control-label">Formule</label>
                                <select id="formule" name="formule" class="form-control">
                                    <option value="1">Starter</option>
                                    <option value="2">Basis</option>
                                    <option value="3">Professioneel</option>
                                </select>

                            </div>

                            <div class="col-md-12 form-group">
                               <p>Samenvatting van gekozen optie</p>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="paymentOptions" class="control-label">Betalingsmethode</label>
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label for="paymentOptions-0">
                                                <input type="radio" name="checkboxes" id="paymentOptions-0" value="1">
                                                Facturatie
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="checkboxes-1">
                                                <input type="radio" name="checkboxes" id="paymentOptions-1" value="2">
                                                Online betaling
                                            </label>
                                        </div>
                                    </div>
                            </div>


                            // Mollie implementatie









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