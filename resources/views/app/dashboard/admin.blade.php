<div class="row">
    <div class="col-md-2">
        <div class="panel panel-default" >
            <div class="panel-body text-center">
                <strong>Ongeconfirmeerde accounts</strong>
                <h4>{{$unconfirmed}}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">

        <div class="panel panel-default" >
            <div class="panel-body text-center">
                <strong>Openstaande betalingen</strong>
                <h4>{{$open_payments}}</h4>
            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default" >
            <div class="panel-heading">
                Recente registraties
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Registratiedatum</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody id="account-list">
                    @foreach ($users as $user)
                            <tr id="user-{{$user->id}}">
                                <td class="table-text">
                                    <div>{{  $user->created_at }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $user->firstname }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{  $user->lastname }}</div>
                                </td>




                                <td>
                                    <div class="btn-toolbar">
                                        <a href="{{url('accounts/'.$user->id)}}" class="btn btn-success">Toon gegevens</a>
                                    </div>
                                </td>
                            </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>