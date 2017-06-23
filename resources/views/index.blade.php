@extends('layouts.front')

@section('content')
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" >
                    <img alt="Brand" src="/img/logo-navbar30.png" style="border-radius:50%">
                    {{--                {{ config('app.name', 'SmartSlim') }}--}}
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="#product">Product</a></li>
                    <li><a href="#missie">Missie</a></li>
                    <li><a href="#services">Diensten</a></li>
                    <li><a href="#formules">Formules</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        @if(Auth::user()->hasRole('admin'))
                        <li><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                        @endif
                        @if(Auth::user()->hasRole('dietician'))
                        <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            @endif
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Uitloggen
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero-unit">
        <div class="hero-text">
            <h1>SmartSlim</h1>
            <h4>Het platform voor diëtisten!</h4>
            <a href="{{route('register')}}" class="btn btn-info">Probeer nu</a>
            </div>
    </div>


    <section id="product">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-4">
                    <div class="text-center circle"  style="padding-top: 40px"><img  src="/img/database.png" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <h4><strong>Beheer uw cliëntdossiers in de cloud</strong></h4>
                        <h4 style="color:#A271E4;">Altijd toegankelijk</h4>
                        <p class="col-md-7">Met de druk van een knop kan u alle cliënten info raadplegen. SmartSlim bundelt alle informatie per klant in een overzichtelijk profielpagina. </p>
                    </div>
                    <div class="row">
                        <ul>
                            <li>Creëer onmiddelijk een professioneel opvolging </li>
                            <li>Beheer alle informatie op één plaats</li>
                            <li>Mis geen enkel item</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="missie" style="background-color: #464646;height:200px;">
        <div class="container">
            <div class="row" >
                <div class="col-md-12">
                <div class="text-center" style="color: white";>
                    <h4><strong  style="color: white";>Missie</strong></h4>

                    <h4 style="color: white";>"Een kwaliteitsvol patiëntbeheersysteem aanbieden voor diëtisten"</h4>
                    <h5 style="color: lightgrey";>"Consiste informatie inzamelen en aanbieden voor betere service"</h5>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="text-center">
                <div class="row ">
                    <div class="col-md-3">
                        <h5 style="color:#9C68E3">Cliëntbeheer</h5>
                        <h1><i class="fa fa-address-card-o" aria-hidden="true" ></i></h1>
                    </div>
                    <div class="col-md-3">
                        <h5 style="color:#9C68E3">Detailweergave</h5>
                        <h1><i class="fa fa-bar-chart" aria-hidden="true" ></i></h1>
                    </div>
                    <div class="col-md-3">
                        <h5 style="color:#9C68E3">Toegankelijk</h5>
                        <h1><i class="fa fa-database" aria-hidden="true" ></i></h1>
                    </div>
                    <div class="col-md-3">
                        <h5 style="color:#9C68E3">Bezoekopvolging</h5>
                        <h1><i class="fa fa-list" aria-hidden="true" ></i></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="formules">
        <div class="container">
            <div class="row">
                <!--Panel met prijzen-->
                <div class="col-md-3 text-center">
                    <div class="panel panel-default panel-pricing">
                        <div class="panel-heading">
                            <!--<i class="fa fa-desktop"></i>-->
                            <h3>Start</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>Gratis</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-address-card"></i>  Cliëntbeheer</li>
                            <li class="list-group-item"><i class="fa fa-bar-chart"></i>  Dashboard</li>
                            <li class="list-group-item"><i class="fa fa-user-o"></i>  Max. 10 cliënten/maand</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-primary" href="{{ route('register') }}">Inschrijven</a>
                        </div>
                    </div>
                </div>
                <!--Panel met prijzen-->
                <div class="col-md-offset-1 col-md-3 text-center">
                    <div class="panel panel-default panel-pricing">
                        <div class="panel-heading">
                            <!--<i class="fa fa-desktop"></i>-->
                            <h3>Basis</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>25€ per maand</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-address-card"></i>  Cliëntbeheer</li>
                            <li class="list-group-item"><i class="fa fa-calendar-check-o"></i> Agenda</li>
                            <li class="list-group-item"><i class="fa fa-user-o"></i>  Max. 30 cliënten/maand</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-primary" href="{{ route('register') }}">Inschrijven</a>
                        </div>
                    </div>
                </div>
                <!--Panel met prijzen-->
                <div class="col-md-offset-1 col-md-3 text-center">
                    <div class="panel panel-default panel-pricing">
                        <div class="panel-heading">
                            <!--<i class="fa fa-desktop"></i>-->
                            <h3>Professioneel</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>75€ per maand</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-address-card"></i>  Cliënten logboek</li>
                            <li class="list-group-item"><i class="fa fa-calendar-check-o"></i> Afspraak module</li>
                            <li class="list-group-item"><i class="fa fa-user-o"></i>  Max. 60 cliënten/maand</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-primary" href="{{ route('register') }}">Inschrijven</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="alert alert-success" id="success" hidden>Uw vraag werd verzonden.</div>
                <form class="form" role="form" id="form-contact">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contactName">Naam</label>
                            <input type="text" class="form-control" name ="contactName" placeholder="Naam" required>
                        </div>
                        <div class="form-group">
                            <label for="contactMail">Email</label>
                            <input type="email" class="form-control" name ="contactMail" placeholder="E-mail" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contactMessage">Bericht</label>
                            <textarea class="form-control" rows="5" name="contactMessage" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right" id="send-contact">Verzenden</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
    @include('index.cookieConsent')

    <footer>
        <div class="container">
            <p> Copyright &copy; Philip Haex</p>
        </div>
    </footer>
    </div>


@endsection