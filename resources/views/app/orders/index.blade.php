@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h4>Overzicht facturatie</h4>
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
                            @if($user['paymentStatus']==1)
                                <tr id="payment-{{$user['payment_id']}}">
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
                                            <button type="submit" class="btn btn-success confirm-modal" data-toggle="modal" data-target="Modal-confirm-{{$user['payment_id']}}">
                                                Bevestig betaling
                                            </button>
                                            {{--confirm modal--}}
                                            <div id="Modal-confirm-{{$user['payment_id']}}" class="modal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title">Bevestiging</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Wilt u deze betaling bevestigen?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <form>
                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="payment_id" value="{{$user['payment_id']}}">
                                                                <button type="submit" class="btn btn-default confirm-payment">
                                                                    Bevestigen
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

        <div class="panel panel-default">
            <div class="panel-heading">
                Foutief verlopen betalingen
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                @if (count($users) > 0)

                    <!-- Table Headings -->
                        <thead>
                        <th>Factuurdatum</th>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Bedrijf</th>
                        <th>Betalingsmethode</th>

                        <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody id="client-list">
                        @foreach ($users as $user)
                            @if($user['paymentStatus']==2)
                                <tr id="payment-{{$user['payment_id']}}">
                                    <td class="table-text">
                                        <div>{{  $user['dateOfPayment'] }}</div>
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
                                            <a href="{{url('/orders/edit/'.$user['payment_id'])}}" class="btn btn-success">
                                                Betaling wijzigen
                                            </a>

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