<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="pull-right" style="padding-top: 5px;">
                    <h5>{{$amount}} / {{$limit}} </h5>
                </div>

                <h5>Cliënten ingeschreven</h5>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar" style="width: {{$percent}}%">

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@include('app.dashboard.list')