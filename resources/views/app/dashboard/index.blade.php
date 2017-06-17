@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h4>Overzicht</h4>
            </div>

        </div>
        @if(Auth::user()->hasRole('dietician'))
            @include('app.dashboard.dietician')
        @endif
        @if(Auth::user()->hasRole('admin'))
            @include('app.dashboard.admin')
        @endif
    </div>

@endsection