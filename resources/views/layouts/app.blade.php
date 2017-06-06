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
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
            <a class="navbar-top" href="{{url('/')}}" >SmartSlim</a>
            <div class="pull-right">
                <a class="navbar-top" href="{{url('/')}}" >Help</a>
                <a class="navbar-top" href="{{url('/')}}" >Instellingen</a>
                <a class="navbar-top" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
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
            <ul class="nav navbar-nav" id="test">
                <li><i class="fa fa-home"></i><a href="{{url('/dashboard')}}">Dashboard</a></li>
                @if(Auth::user()->hasRole('admin'))
                    <li><a href="{{url('/accounts')}}">Accounts</a></li>
                    <li><a href="{{url('/orders')}}">Facturatie</a></li>
                @endif
                <li><a href="{{url('/clients')}}">Cliënten</a></li>
            </ul>


        </div>
    </div>
</nav>
<div id="content">
    @yield('content')
</div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        console.log('ajax ready');
        $('#add-item').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'items/store/',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'visit_code': $('input[name=visit_code]').val(),
                    'title': $('input[name=title]').val(),
                    'input': $('textarea[name=input]').val()
                },
                datatype: 'JSON',
                success: function (items) {
                    console.log("item is toegevoegd");


                    $.each(items, function (key, item) {
//                            console.log(key);
//                            console.log(item['title']);
                        $('tbody').append('<tr id="row-item-'+item['id']+'"><td class="table-text"><div>'+item['title']+'</div></td>' +
                                '<td class="table-text"><div>'+item['input']+'</div></td><td><div class="btn-toolbar">'+
                                '<form role="form">'+
                                '{{ csrf_field() }}'+
                                '<input name="id" value='+item['id']+' hidden>'+
                                '<button class="btn btn-default edit-item"><i class="fa fa-pencil"></i></button></form>'+
                                '<form>'+
                                '{{ csrf_field() }}'+
                                '<input name="id" value='+item['id']+' hidden>'+
                                '<button class="btn btn-default delete-item"><i class="fa fa-trash"></i></button></form>'+
                                '</div></td>')

                    });
                    console.log("lijst met items is opgehaald");
                    console.log(items);
                    $("input[name=title]").val('');
                    $("textarea[name=input]").val('');

                    /*    $('tbody').append('<tr><td class="table-text"><div>'+$("input[name=title]").val()+'</div></td>' +
                     '<td class="table-text"><div>'+$("textarea[name=input]").val()+'</div></td>' +
                     '<td class="table-text"><div>"buttons"</div></td></tr>')*/
                }
            });

        });
        $('body').on('click','.edit-item' ,function (e) {
            e.preventDefault();
            console.log('werkt');
            $.ajax({
                url: 'items/edit/',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('input[name=id]').val()
                },
                datatype: 'JSON',
                success: function (item) {
                    console.log(item[0]);
                    $selector = "#row-item-"+item[0]['id'];
                    $row = $($selector).closest("tr");
                    console.log($selector);
//                    console.log(e.offsetParent);
//                 $.closest("tr").remove());
                    $row.remove();
                    $("input[name=title]").val(item[0]['title']);
                    $("textarea[name=input]").val(item[0]['input']);

                }
            });

        });
        $('body').on('click','.delete-item' ,function (e) {
            e.preventDefault();
            console.log('werkt');
            $.ajax({
                url: 'items/delete/',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('input[name=id]').val()
                },
                datatype: 'JSON',
                success: function () {
                    $selector = "#row-item-"+$('input[name=id]').val();
                    $row = $($selector).closest("tr");
                    $row.remove();

                }
            });

        });
        $('.delete-modal').on('click' , function(e){
            e.preventDefault();
            var key = $(this).data('target');

            console.log(key);
            $('#'+key).modal();
        });

        $('.delete-visit').on('click',function (e) {
            e.preventDefault();
            console.log('werkt');
            $.ajax({
                url: 'visits/delete/',
                type: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'visit_code': $('input[name=visit_code]').val()
                },
                datatype: 'JSON',
                success: function () {
                    $visit_code = $('input[name=visit_code]').val();
                    $row = $("#row-visit-"+$visit_code).closest("tr");
                    $row.remove();
                    //Call to modal close button
                    $('#Modal-delete-'+$visit_code+" .close").click()
                }
            });

        });
    });

</script>
</body>
</html>
