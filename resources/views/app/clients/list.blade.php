
{{--@if (count($clients) > 0)--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            Clients
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>#</th>
                <th>Achternaam</th>
                <th>Voornaam</th>

                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
              {{--  @foreach ($clients as $client)
                    <tr>
                        <!-- Store Name -->
                        <td class="table-text">
                            <div>{{ $client->id }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->firstname }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $client->lastname }}</div>
                        </td>

                        <td>
                            <div class="btn-toolbar">
                                <!-- Select Button -->
                                <form action="{{ url('product') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$client->id}}">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check-circle-o"></i>
                                    </button>
                                </form>
                                <form action="{{ url('client/edit/'.$client->id) }}" method="POST">
                                    {{ csrf_field() }}


                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </form>
                                <form action="{{ url('client/'.$client->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>
{{--@endif--}}