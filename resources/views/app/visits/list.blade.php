
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
                  <tr>
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
                              <!-- Select Button -->
                              <form action="{{ url('product') }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="visit_code" value="{{$visit->visit_code}}">
                                  <button type="submit" class="btn btn-success">
                                      <i class="fa fa-check-info"></i>
                                  </button>
                              </form>
                              <form action="{{ url('visits/delete/'.$visit->visit_code) }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}

                                  <input type="hidden" name="client_id" value="{{$client->id}}">
                                  <button type="submit" class="btn btn-default delete-visit">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </form>
                          </div>
                      </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
        @else
        <div>
            Nog geen bezoeken geregistreerd.
        </div>
        @endif

    </div>
