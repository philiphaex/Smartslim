@extends('layouts.front')

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                @if(Session::has('unconfirmed'))
                    <div class="alert alert-warning">


                        <h5>{{ Session::get('unconfirmed') }}

                        </h5>

                    </div>
                @endif
                @if(Session::has('danger'))
                    <div class="alert alert-danger">
                        <h5>{{ Session::get('danger') }}

                        </h5>


                    </div>
                @endif
                <div class="account-wall">
                    <img class="profile-img" src="/img/logo.png"   alt="SmartSlim">
                    <h1 class="text-center login-title">Welkom bij SmartSlim</h1>

                    <form class="form-signin" method="POST" action="{{ url('login') }}">
                        {{ csrf_field() }}
                        <input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                        <a href="#" class="pull-right need-help">Help? </a><span class="clearfix"></span>
                    </form>

                </div>
                <a href="{{url('/register')}}" class="text-center new-account">Nog geen account? Schrijf nu in </a>
            </div>
        </div>
    </div>




@endsection
