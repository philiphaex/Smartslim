
{{--ongeconfirmeerde accounts--}}
@if ($unconfirmed > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Ongeconfirmeerde accounts
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>Registratiedatum</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Bedrijf</th>
                <th>Abonnement</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody id="client-list">
                @foreach ($users as $user)
                    @if($user['confirmed']==0)
                        <tr id="account-unconfirmed-{{$user['id']}}">
                            <td class="table-text">
                                <div>{{  $user['date'] }}</div>
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
                                <div>{{  $user['role'] }}</div>
                            </td>


                            <td>
                                <div class="btn-toolbar">
                                    <!-- Select Button -->
                                    <button type="submit" class="btn btn-success account-modal" data-toggle="modal" data-target="Modal-account-{{$user['id']}}">
                                        Confirmeer account
                                    </button>
                                    {{--confirm modal--}}
                                    <div id="Modal-account-{{$user['id']}}" class="modal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Bevestiging</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Wilt u deze account bevestigen?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <form>
                                                        {{ csrf_field() }}

                                                        <input type="hidden" name="user_id" value="{{$user['id']}}">
                                                        <button type="submit" class="btn btn-default confirm-account">
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

                </tbody>

            </table>
        </div>
    </div>
@endif
{{--abonnement verlopen--}}
@if ($overdue > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Accounts met verlopen abonnenementen
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Bedrijf</th>
                <th>Abonnement</th>
                <th>Start abonnement</th>
                <th>Einde abonnement</th>

                </thead>

                <!-- Table Body -->
                <tbody id="client-list">
                @foreach ($users as $user)
                    @if($user['payment_status']==5)
                        <tr id="account-overdue-{{$user['id']}}">

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
                                <div>{{  $user['role'] }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{  $user['dateStartSubscription'] }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{  $user['dateEndSubscription'] }}</div>
                            </td>



                        </tr>
                    @endif
                @endforeach

                </tbody>

            </table>
        </div>
    </div>
@endif

{{--alle accounts--}}
<div class="panel panel-default">
    <div class="panel-heading">
        Accounts
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Table Headings -->
            <thead>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Bedrijf</th>
            <th>Abonnement</th>
            <th>Aantal clienten</th>

            <th>&nbsp;</th>
            </thead>

            <!-- Table Body -->
            <tbody id="client-list">
            @foreach ($users as $user)
                <tr id="account-{{$user['id']}}">

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
                        <div>{{  $user['role'] }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{  $user['clients'] }}</div>
                    </td>

                    <td>
                        <div class="btn-toolbar">
                            <!-- Select Button -->
                            <a href="{{url('accounts/'.$user['id'])}}" class="btn btn-success">Toon gegevens</a>

                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
</div>
