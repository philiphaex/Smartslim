@extends('layouts.app')

@section('content')
    @if(Auth::user()->hasRole('admin'))

        <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h4>Account beheer</h4>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{url('accounts/create')}}" class="btn btn-primary btn-block">Gebruiker toevoegen</a>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <form class="form" role="form" >
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <input id="search-account" type="text" class="form-control" placeholder="Zoeken" name="keyword">
                                <span class="form-control-feedback"> <i class="fa fa-search"></i></span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        @include('app.accounts.list')

    </div>



    </div>
    @endif
@endsection