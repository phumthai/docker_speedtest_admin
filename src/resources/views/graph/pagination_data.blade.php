
@foreach($data as $row)
<tr>
    <td>{{ $row->testcode}}</td>
    <td>{{ $row->timestamp}}</td>
    <td>{{ $row->ip}}</td>
    <td>{{ $row->dl}}</td>
    <td>{{ $row->ul}}</td>
    <td>{{ $row->ping}}</td>
    <td>{{ $row->jitter}}</td>
    <td>{{ $row->userid }}</td>
    <td>{{ $row->subnet }}</td>
    <td>{{ $row->apname}}</td>
</tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $data->links() !!}
    </td>
</tr>