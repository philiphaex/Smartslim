
<div class="panel panel-default">
    <div class="panel-heading">
        Bezoeken
    </div>

    <div class="panel-body">
        @if (count($visits) > 0)
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>Datum</th>
                <th>Gewicht</th>
                <th>BMI</th>
                <th>Info</th>

                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($visits as $visit)
                    <tr id="row-visit-{{$visit->visit_code}}">
                        <!-- Store Name -->
                        <td class="table-text">
                            <div>
                                @php

                                    echo date_format($visit->created_at,"d/m/Y");;
                                @endphp
                            </div>
                        </td>
                        <td class="table-text">
                            <div>{{ $visit->weight }}</div>
                        </td>
                        <td class="table-text">
                            <div>
                                @php
                                    echo round(($visit->weight)/($client->length*$client->length)*10000,1);
                                @endphp
                            </div>
                        </td>
                        <td class="table-text">
                            <div>{{ $visit->info }}</div>
                        </td>


                        <td>
                            <div class="btn-toolbar">
                                <!-- Show Button -->
                                <form action="{{ url('visits/show/'.$visit->visit_code) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-info"></i>
                                    </button>
                                </form>
                                <!-- Delete Button -->
                                <button type="submit" class="btn btn-default delete-modal" data-toggle="modal" data-target="Modal-delete-{{$visit->visit_code}}">
                                    <i class="fa fa-trash" ></i>
                                </button>
                            </div>
                        </td>
                        {{--Delete modal--}}
                        <div id="Modal-delete-{{$visit->visit_code}}" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Bevestiging</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Wilt u dit bezoek verwijderen?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        {{--<form action="{{ url('visits/delete/'.$visit->visit_code) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <input type="hidden" name="client_id" value="{{$client->id}}">
                                            <button type="submit" class="btn btn-default delete-visit">
                                                Delete
                                            </button>
                                        </form>--}}
                                        <form>
                                            {{ csrf_field() }}

                                            <input type="hidden" name="visit_code" value="{{$visit->visit_code}}">
                                            <button type="submit" class="btn btn-default delete-visit">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </tr>
                    {{--delete modal--}}

                @endforeach
                </tbody>
            </table>
        @else
            <div>
                Nog geen bezoeken geregistreerd.
            </div>
        @endif

    </div>
</div>
