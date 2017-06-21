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
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
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
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#subscription').on('change',function(){
                $subscription = $('#subscription option:selected').text();
                console.log('$subscription')
                if($subscription == 'Starter'){
                    $('#paymentOptions').hide();
                }else{
                    $('#paymentOptions').show();
                }
            });
            //Contactmodal
            $('#send-contact').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'send/contact',
                    type: 'post',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'contactName': $('input[name=contactName]').val(),
                        'contactMail': $('input[name=contactMail]').val(),
                        'contactMessage': $('textarea[name=contactMessage]').val()
                    },
                    datatype: 'JSON',
                    success: function () {
                        console.log("mail is verzonden");
                    }
                });
                $("#success").show();

                setTimeout(function() { $("#success").hide(); }, 3000);

                $("input[name=contactName]").val('');
                $("input[name=contactMail]").val('');
                $("textarea[name=contactMessage]").val('');
            });
            $('#accept-cookies').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'privacy/accept',
                    type: 'get',
                    success: function () {
                    }
                });
            });
            //Helpmodal
            $('.help-modal').on('click' , function(e){
                e.preventDefault();
                var key = $(this).data('target');

                console.log(key);
                $('#'+key).modal();
            });
            $('#send-help').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'send/help',
                    type: 'post',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'firstname': $('input[name=firstname]').val(),
                        'lastname': $('input[name=lastname]').val(),
                        'email': $('input[name=email]').val(),
                        'helpSubject': $('input[name=helpSubject]').val(),
                        'helpMessage': $('textarea[name=helpMessage]').val(),
                    },
                    datatype: 'JSON',
                    success: function () {
                        $("input[name=helpSubject]").val('');
                        $("textarea[name=helpMessage]").val('');
                        $('#Modal-help').modal('toggle');
                        $('.modal-backdrop').remove();
                    }
                });
            });
        })
    </script>
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
