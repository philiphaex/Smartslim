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

        <div class="col-md-6">
            <div class="row">

                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Bezoekitems
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                    <label for="weight" class="col-md-3control-label">Titel</label>
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
                                    <label for="info" class="col-md-3control-label">Input</label>
                                    <div class="form-group">
                                        <textarea id="info" class="form-control" rows="3" name="info"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success pull-right">Toevoegen</button>
                        </div>

                    </div>

            </div>
            <div class="row">
                    <div class="panel panel-default" >
                        <div class="panel-heading">
                            Bezoekgegevens
                        </div>
                        <div class="panel-body">
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

                        </div>

                    </div>

            </div>
        </div>
        <div class="col-md-6">
            @include('app.items.list')
        </div>
    </div>
@endsection