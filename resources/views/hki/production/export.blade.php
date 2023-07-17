<table>
    <thead>
    <tr>
        <th rowspan="2">LINE</th>
        <th colspan="{{count($date)+1}}">PERIODE : @php echo date('m'); @endphp</th>

    </tr>
    <tr>
        <th>Date/Shift</th>
        @foreach ($date as $item)
            <th>{{$item->tanggal}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @php
            $retdata = array();

        @endphp
        @foreach ($export as $item)
        <tr>
            <td>{{$item->line}}</td>
            <td>{{$item->shift}}</td>
            @foreach ($group as $row => $columns)
                @foreach ($columns as $row2 => $column2)
                        <td>{{$column2->nilai}}</td>
                @endforeach
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>