<div class="panel panel-default">

    <div class="panel-heading">
        <div class="pull-right" style="padding-top: 5px;">
            <a href="{{url('clients/create')}}" class="btn btn-primary ">Cliënt toevoegen</a>
        </div>
        <h5>Overzicht recente registraties</h5>
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">
        @if (count($clients) > 0)

            <!-- Table Headings -->
                <thead>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Datum van registratie</th>

                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody id="client-list">
                @foreach ($clients as $client)
                    <tr id="client-".{{$client->id}}>

                        <td class="table-text">
                            <div>{{ $client->firstname }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->lastname }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->created_at }}</div>
                        </td>
                        <td>
                            <div class="btn-toolbar">
                                <!-- Select Button -->
                                <a href="{{url('clients/'.$client->id)}}" class="btn btn-success"> <i class="fa fa-check-circle-o"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @else
                    <div>
                        Er werden nog geen cliënten geregistreerd.
                    </div>
                @endif
                </tbody>
        </table>
    </div>
</div>