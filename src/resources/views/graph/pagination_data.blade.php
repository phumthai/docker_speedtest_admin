
@foreach($data as $row)
<tr>
    <td>{{ $row->testcode}}</td>
    <td>{{ $row->timestampss}}</td>
    <td>{{ $row->ip}}</td>
    <td>{{ $row->mac}}</td>
    <td>{{ $row->dl}}</td>
    <td>{{ $row->ul}}</td>
    <td>{{ $row->ping}}</td>
    <td>{{ $row->jitter}}</td>
    <td>{{ $row->userid }}</td>
    <td>{{ $row->subnet }}</td>
    <td>{{ $row->apname}}</td>
    <td>{{ $row->ssid}}</td>
    <td>{{ $row->utilize24}}</td>
    <td>{{ $row->utilize5}}</td>
    <td>{{ $row->clientnum24}}</td>
    <td>{{ $row->clientnum5}}</td>
</tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $data->links() !!}
    </td>
</tr>