
@foreach($data as $row)
<tr>
    <td>{{ $row->subnet }}</td>
    <td>{{ $row->dl}}</td>
    <td>{{ $row->ul}}</td>
    <td>{{ $row->ping}}</td>
    <td>{{ $row->jitter}}</td>
</tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $data->links() !!}
    </td>
</tr>