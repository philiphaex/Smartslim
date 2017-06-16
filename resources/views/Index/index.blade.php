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
                <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="Brand" src="/img/logo-navbar30.png">
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->firstname }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>

                                </li>
                            </ul>
                        </li>
                        <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
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
    <section class="hero-unit">
    </section>


    <section id="product">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </section>

    <section id="missie">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">

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
                <div class="col-md-3 text-center">
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
                <div class="col-md-3 text-center">
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
                <!--Panel met prijzen-->
                <div class="col-md-3 text-center">
                    <div class="panel panel-default panel-pricing">
                        <div class="panel-heading">
                            <!--<i class="fa fa-desktop"></i>-->
                            <h3>Maatwerk</h3>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong>Op afspraak</strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-window-restore"></i>  Alle SmartSlim modules  </li>
                            <li class="list-group-item"><i class="fa fa-file"></i>  Formulieren op maat</li>
                            <li class="list-group-item"><i class="fa fa-clock-o"></i> 24/7 Ondersteuning</li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-primary" href="{{ route('register') }}">Contact</a>
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

    <!-- Google Analytics -->



    </div>


@endsection