<!DOCTYPE html>
<html>
    <head>
        <title>Speedtest table</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
        <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
        @include('layouts.partials.navbar')
    </head>
<body>
    <br />
    <div class="container">
    @auth
        <h3 align="center">Speedtest table</h3><br />
        <div class="row">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="serach" id="serach" class="form-control" placeholder="search"/>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>TestCode</th>
                        <th class="sorting" data-sorting_type="asc" data-column_name="timestamp" style="cursor: pointer">Timestamp </th>
                        <th class="sorting" data-sorting_type="asc" data-column_name="ip" style="cursor: pointer">IP </th>
                        <th>MAC</th>
                        <th>Download</th>
                        <th>Upload</th>
                        <th>Ping</th>
                        <th>Jitter</th>
                        <th class="sorting" data-sorting_type="asc" data-column_name="userid" style="cursor: pointer">User </th>
                        <th class="sorting" data-sorting_type="asc" data-column_name="subnet" style="cursor: pointer">Subnet </th>
                        <th class="sorting" data-sorting_type="asc" data-column_name="apname" style="cursor: pointer">AP Name </th>
                        <th>SSID</th>
                        <th>Utilize 2.4GHz</th>
                        <th>Utilize 5GHz</th>
                        <th>Client 2.4GHz</th>
                        <th>Client 5GHz</th>
                    </tr>
                </thead>
                <tbody>
                    @include('graph.pagination_data')
                </tbody>
            </table>
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
        </div>
    @endauth
    @guest
        <h1>Dashboard</h1>
        <p class="lead">Please login to view the restricted data.</p>
    @endguest
    </div>
</body>
</html>

<script>
    $(document).ready(function(){

        function fetch_data(page, sort_type, sort_by, query)
        {
            $.ajax({
            url:"/pagination/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
            success:function(data)
            {
                $('tbody').html('');
                $('tbody').html(data);
            }
            })
        }

        $(document).on('keyup', '#serach', function(){
            var query = $('#serach').val();
            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = $('#hidden_page').val();
            fetch_data(page, sort_type, column_name, query);
        });

        $(document).on('click', '.sorting', function(){
            var column_name = $(this).data('column_name');
            var order_type = $(this).data('sorting_type');
            var reverse_order = '';
            if(order_type == 'asc')
            {
                $(this).data('sorting_type', 'desc');
                reverse_order = 'desc';
                clear_icon();
                $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
            }
            if(order_type == 'desc')
            {
                $(this).data('sorting_type', 'asc');
                reverse_order = 'asc';
                clear_icon
                $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
            }
            $('#hidden_column_name').val(column_name);
            $('#hidden_sort_type').val(reverse_order);
            var page = $('#hidden_page').val();
            var query = $('#serach').val();
            fetch_data(page, reverse_order, column_name, query);
        });

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();

            var query = $('#serach').val();

            $('li').removeClass('active');
                    $(this).parent().addClass('active');
            fetch_data(page, sort_type, column_name, query);
        });

    });
</script>
