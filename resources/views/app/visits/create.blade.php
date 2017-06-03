@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="padding-top: 5px;">
                        <a href="{{url('clients/'.$client->id)}}" class="btn btn-danger">Annuleren</a>
                    </div>
                    <h4 >Bezoek - {{$today}}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="row">

                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Bezoekitems
                        </div>
                        <div class="panel-body">
                            <form class="form" role="form">
                                {{ csrf_field() }}
                                <div class="row">
                                <div class="col-md-12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-3 control-label">Titel</label>
                                    <input id="title" type="text" class="form-control" name="title"  required>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="input" class="col-md-3 control-label">Input</label>
                                    <div class="form-group">
                                        <textarea id="input" class="form-control" rows="3" name="input"></textarea>
                                    </div>
                                </div>
                            </div>
                                <input name="visit_code" value="{{$visit_code}}" hidden>
                            <button class="btn btn-success pull-right" id="add-item">Toevoegen</button>
                            </form>
                        </div>

                    </div>

            </div>
            <div class="row">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Bezoekgegevens
                        </div>
                        <div class="panel-body">
                            <form class="form" role="form" method="POST" action="{{url('clients/'.$client->id.'/visits/store'.$visit_code)}}">
                                {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12 form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                    <label for="weight" class="col-md-3control-label">Gewicht</label>
                                    <input id="weight" type="text" class="form-control" name="weight"  required>

                                    @if ($errors->has('weight'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="info" class="col-md-3control-label">Opmerkingen</label>
                                    <div class="form-group">
                                        <textarea id="info" class="form-control" rows="3" name="info"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info pull-right">Bezoek opslaan</button>
                            </form>
                        </div>

                    </div>

            </div>
        </div>
        <div class="col-md-7">
            @include('app.items.list')
        </div>
    </div>

@endsection