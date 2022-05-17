<div class="row">
    <table class="table table-borderd table-striped">
        <tr>
            <th>Timestamp</th>
            <th>IP</th>
            <th>User</th>
            <th>Download</th>
            <th>Upload</th>
            <th>Ping</th>
            <th>Subnet</th>
            <th>AP Name</th>
        </tr>
        @foreach($table as $row)
        <tr>
            <td>{{ $row->timestamp }}</td>
            <td>{{ $row->ip }}</td>
            <td>{{ $row->userid }}</td>
            <td>{{ $row->dl }}</td>
            <td>{{ $row->ul }}</td>
            <td>{{ $row->ping }}</td>
            <td>{{ $row->subnet }}</td>
            <td>{{ $row->apname }}</td>
        </tr>
        @endforeach()
    </table>
    <div class="d-flex justify-content-center">
        {!! $table->links() !!}
    </div>
</div>
