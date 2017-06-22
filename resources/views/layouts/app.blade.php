<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SmartSlim') }}</title>

    <!-- Bootstrap core CSS -->
    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    {{--<nav class="navbar  navbar-default">--}}
    <div  id="nav-top">
        <div class="container">
            <span class="brand navbar-top" >SmartSlim</span>
            <div class="pull-right">
                @if(Auth::user()->hasRole('dietician'))
                    <a class="navbar-top help-modal btn btn-link"  data-toggle="modal" data-target="Modal-help"  style="text-decoration: none;">Help</a>
                    <a class="navbar-top btn btn-link" href="{{url('/settings')}}" >Instellingen</a>
                @endif
                <a class="navbar-top  btn btn-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Uitloggen
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    {{--</nav>--}}
</div>

<nav class="navbar navbar-default" id="nav-dashboard">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="submenu-item {{Request::is('*dashboard*') ? 'active' : null }}">
                            @if(Auth::user()->hasRole('admin'))
                            <a href="{{url('/admin/dashboard')}}">
                            @endif
                            @if(Auth::user()->hasRole('dietician'))
                            <a href="{{url('/dashboard')}}">
                            @endif
                            <div class="row"> <i class="fa fa-home"></i></div>
                            <div class="row">Dashboard</div>
                            </a>
                </li>
                {{--Admin Menu--}}
                @if(Auth::user()->hasRole('admin'))
                    <li class="submenu-item {{Request::is('accounts*') ? 'active' : null }}">
                        <a href="{{url('/accounts')}}">
                            <div class="row"><i class="fa fa-id-card-o"></i></div>
                            <div class="row">Accounts</div>
                        </a>
                    </li>
                    <li class="submenu-item-end {{Request::is('orders*') ? 'active' : null }}">
                        <a href="{{url('/orders')}}">
                            <div class="row"> <i class="fa fa-book"></i></div>
                            <div class="row">Facturatie</div>
                        </a>
                    </li>
                @endif
                {{--Dietician menu--}}
                @if(Auth::user()->hasRole('dietician'))
                    <li class="submenu-item-end {{Request::is('clients*') ? 'active' : null }}">
                        <a href="{{url('/clients')}}">
                            <div class="row">  <i class="fa fa-users"></i></div>
                            <div class="row">Cliënten</div>
                        </a>
                    </li>
                @endif

            </ul>



        </div>
    </div>
</nav>

{{--Help modal--}}
<div id="Modal-help" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Help</h4>
            </div>
            <div class="modal-body">
                <form class="form" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="contactName">Onderwerp</label>
                        <input type="text" class="form-control" name ="helpSubject"  required>
                    </div>
                    <div class="form-group">
                        <label for="contactMessage">Bericht</label>
                        <textarea class="form-control" rows="5" name="helpMessage" required></textarea>
                    </div>
                    <input name="email" value="{{Auth::user()->email}}" hidden>
                    <input name="firstname" value="{{Auth::user()->firstname}}" hidden>
                    <input name="lastname" value="{{Auth::user()->lastname}}" hidden>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>

                    <button type="submit" class="btn btn-primary pull-right" id="send-help">Verzenden</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="content">
    @yield('content')
</div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>


</body>
</html>
