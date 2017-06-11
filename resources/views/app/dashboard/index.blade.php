@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h3>Overzicht</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
        <div class="panel panel-default" >
            <div class="panel-heading">
               <h4>Cliënten ingeschreven</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar" style="width: {{$percent}}%">
                                {{$amount}} / {{$limit}}
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            </div>
        </div>

        </div>
            @include('app.dashboard.list');
    </div>

@endsection