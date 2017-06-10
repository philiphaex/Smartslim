@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h3>Overzicht</h3>
            </div>

        </div>

        <div class="panel panel-default" >
            <div class="panel-heading">
                Cliënten ingeschreven
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar" style="width: {{$percent}}%">
                                <span class="sr-only">60% Complete</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <a href="{{url('clients/create')}}" class="btn btn-primary btn-block" style="height:100px; text-align:center;">
                    <i class="fa fa-user"></i><br>Cliënt toevoegen</a>
            </div>
            <div class="col-md-9">

            </div>
        </div>

    </div>

@endsection