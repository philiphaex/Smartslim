@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h4>Overzicht</h4>
            </div>

        </div>
            @include('app.admin.dashboard')
    </div>

@endsection