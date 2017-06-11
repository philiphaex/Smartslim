@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="panel panel-heading" style="background-color: whitesmoke">
            <h3>Overzicht facturatie</h3>
        </div>

    </div>

<div class="panel panel-default">
    <div class="panel-heading">
        Openstaande betalingen
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">
        @if (count($users) > 0)

            <!-- Table Headings -->
                <thead>
                <th>Factuurdatum</th>
                <th>Vervaldag</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Bedrijf</th>
                <th>Betalingsmethode</th>

                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody id="client-list">
                @foreach ($users as $user)
                   @if($user['payment']==1)
                    <tr id="client-".{{$user['id']}}>
                        <td class="table-text">
                            <div>{{  $user['dateOfPayment'] }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{  $user['dueDate']}}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $user['firstname'] }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{  $user['lastname'] }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{  $user['business'] }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{  $user['paymentType'] }}</div>
                        </td>


                        <td>
                            <div class="btn-toolbar">
                                <!-- Select Button -->
                                <a href="{{url('clients/'.$user['id'])}}" class="btn btn-success"> <i class="fa fa-check-circle-o"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
                @else
                    <div>
                        Er werden nog geen gebruikers geregistreerd.
                    </div>
                @endif
                </tbody>

        </table>
    </div>
</div>
</div>
@endsection