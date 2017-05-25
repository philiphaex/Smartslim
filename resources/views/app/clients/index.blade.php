@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h3>Cliënten beheer</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{url('clients/create')}}" class="btn btn-primary btn-block">Cliënt toevoegen</a>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <form class="form" role="form" method="POST" action="{{ url('clients/search') }}">
                        {{ csrf_field() }}
                        <div class="col-md-9">
                            <div class="form-group">
                                <input id="searchname" type="text" class="form-control" name="keyword">
                            </div>
                        </div>
                        <div class="col-md-3">
                        <button class="btn btn-default btn-block">Zoeken</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>


{{--        @include('app.clients.list', ['clients' => $clients])--}}
        @include('app.clients.list')

    </div>
@endsection