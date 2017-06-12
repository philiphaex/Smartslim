@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-heading" style="background-color: whitesmoke">
                <h3>Account beheer</h3>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{url('accounts/create')}}" class="btn btn-primary btn-block">Gebruiker toevoegen</a>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <form class="form" role="form" >
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <input id="search-client" type="text" class="form-control" placeholder="Zoeken" name="keyword">
                                <span class="form-control-feedback"> <i class="fa fa-search"></i></span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        @include('app.accounts.list')

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
    </div>



    </div>
@endsection