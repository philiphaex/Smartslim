@extends('layouts.front')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            <div class="well col-md-2 col-md-offset-5 form-registration">
                <div class="loginHeader col-md-12 ">
                    {{--add logo--}}
                    <a href="{{ url('/') }}">
                        <img alt="SmartSlim" src="/img/logo.png">
                    </a>
                </div>
                <div class="loginWelcome">
                <h3>Welkom bij SmartSlim</h3>
                </div>
                    <form role="form" method="POST" action="{{ url('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                        <label for="inputLogin">Login</label>
                        <input type="text" class="form-control" id="inputLogin" placeholder="" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Paswoord</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    <a href="{{url('/register')}}" class="btn btn-default btn-block">Nog geen account? Schrijf nu in</a>
                </form>
                <div class="loginFooter">
                    <p> Copyright &copy; Philip Haex</p>
                </div>
            </div>
        {{--</div>--}}


    {{--</div>--}}

@endsection
