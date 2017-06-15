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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">


        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
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

        })
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
