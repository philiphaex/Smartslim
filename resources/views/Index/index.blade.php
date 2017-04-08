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
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
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
                <form>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inputName">Naam</label>
                            <input type="text" class="form-control" id ="inputName" placeholder="Naam">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id ="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputMessage">Bericht</label>
                            <textarea class="form-control" rows="5" id="inputMessage"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Verzenden</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
    @component('index.cookieConsent')

    @endcomponent
    <footer>
        <div class="container">
            <p> Copyright &copy; Philip Haex</p>
        </div>
    </footer>

    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-96123323-1', 'auto');
        ga('send', 'pageview');

    </script>

    <!-- Theme JavaScript -->

    </div>


@endsection