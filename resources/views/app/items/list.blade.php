
<div class="panel panel-default">
    <div class="panel-heading">                <th>&nbsp;</th>

        Overzicht
    </div>

    <div class="panel-body">
        @if (count($items) > 0)

            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th class="col-md-3">Titel</th>
                <th class="col-md-7">Input</th>

                </thead>

                <!-- Table Body -->
                    <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td class="table-text">
                        <div>{{ $item->title }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $item->input }}</div>
                    </td>
                    </tr>
                        @endforeach
                    </tbody>
            </table>
        @else
            <div>
                Er werden geen items toegevoegd aan dit bezoek.
            </div>
        @endif
    </div>
</div>
