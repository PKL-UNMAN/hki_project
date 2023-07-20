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

        @endphp
        @foreach ($export as $item)
        <tr>
            <td>{{$item->line}}</td>
            <td>{{$item->shift}}</td>
            {{-- <td>{{$item->nilai}}</td> --}}
        </tr>
        @endforeach
    </tbody>
</table>