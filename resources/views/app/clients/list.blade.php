
    <div class="panel panel-default">
        <div class="panel-heading">
            Clients
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">
            @if (count($clients) > 0)

                <!-- Table Headings -->
                <thead>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Laatste bezoek</th>

                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($clients as $client)
                    <tr id="client-".{{$client->id}}>

                        <td class="table-text">
                            <div>{{ $client->firstname }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->lastname }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->visit }}</div>
                        </td>
                        <td>
                            <div class="btn-toolbar">
                                <!-- Select Button -->
                                <a href="{{url('clients/'.$client->id)}}" class="btn btn-success"> <i class="fa fa-check-circle-o"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>
