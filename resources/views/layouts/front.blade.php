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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
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
                                <label for="firstname">Voornaam</label>
                                <input type="text" class="form-control" name ="firstname"  required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Achternaam</label>
                                <input type="text" class="form-control" name ="lastname"  required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mailadres</label>
                                <input type="text" class="form-control" name ="email"  required>
                            </div>
                            <div class="form-group">
                                <label for="contactName">Onderwerp</label>
                                <input type="text" class="form-control" name ="helpSubject"  required>
                            </div>
                            <div class="form-group">
                                <label for="contactMessage">Bericht</label>
                                <textarea class="form-control" rows="5" name="helpMessage" required></textarea>
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>

                            <button type="submit" class="btn btn-primary pull-right" id="send-help">Verzenden</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/front.js') }}"></script>


    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-96123323-1', 'auto');
        ga('send', 'pageview');

    </script>

</body>
</html>
