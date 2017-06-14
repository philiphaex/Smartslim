@extends('layouts.front')

@section('content')

    <div class="container">
        <div class="col-md-offset-3 col-md-6 form-registration">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    Foutmelding
                </div>
                <div class="panel-body">
                   <p>De betaling werd geannuleerd. Als dit foutief is gebeurd gelieve u opnieuw te registreren.</p>
                    <a class="btn btn-primary pull-right" href="{{url('register')}}">Terug</a>
                </div>
            </div>
        </div>
        </div>


@endsection