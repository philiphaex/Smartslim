@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right" style="padding-top: 5px;">
                        <a href="{{url('clients/'.$client_id)}}" class="btn btn-primary">Terug naar Profiel</a>
                    </div>
                    <h4 >Bezoek - {{$date}}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="row">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        Bezoekgegevens
                    </div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="col-md-3 control-label">Gewicht</label>
                                    {{$visit->weight}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="col-md-3 control-label">Opmerkingen</label>
                                    <div class="form-group">
                                       {{$visit->info}}
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-7">
            @include('app.items.list')
        </div>
    </div>



@endsection