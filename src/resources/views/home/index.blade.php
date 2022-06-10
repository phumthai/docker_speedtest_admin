@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        @include('graph.total')
        <div class="row">
            <div class="col-6 border-right">@include('graph.subnet')</div>
            <div class="col-6 border-right">@include('graph.apname')</div>
        </div>
        <br>
        <div class="row text-center">
            <h3>Jumbo Speed</h3>
            <div class="col-2 border-right">
                <div class="card-header">
                    '
                </div>
                <div class="card-body">
                    <p>Average</p>
                    <br><br><br>
                    <p>Max</p>
                    <br><br><br>
                    <p>Min</p>
                    <br><br><br>
                    <p>SD</p>
                </div>
            </div>
            <div class="col-2 border-right">
                <div class="card-header">
                    Download
                </div>
                <div class="card-body">
                    @foreach($Adownload as $row)
                    <p>{{ $row->adl }} Mbps</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MXdownload as $row)
                    <p>{{ $row->mxdl }} Mbps</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MNdownload as $row)
                    <p>{{ $row->mndl }} Mbps</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($SDdownload as $row)
                    <p>{{ $row->sddl }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-2 border-right">
                <div class="card-header">
                    Upload
                </div>
                <div class="card-body">
                    @foreach($Aupload as $row)
                    <p>{{ $row->aul }} Mbps</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MXupload as $row)
                    <p>{{ $row->mxul }} Mbps</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MNupload as $row)
                    <p>{{ $row->mnul }} Mbps</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($SDupload as $row)
                    <p>{{ $row->sdul }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-2 border-right">
                <div class="card-header">
                    Ping
                </div>
                <div class="card-body">
                    @foreach($Aping as $row)
                    <p>{{ $row->aping }} ms</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MXping as $row)
                    <p>{{ $row->mxping }} ms</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MNping as $row)
                    <p>{{ $row->mnping }} ms</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($SDping as $row)
                    <p>{{ $row->sdping }} ms</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-2 border-right">
                <div class="card-header">
                    Jitter
                </div>
                <div class="card-body">
                    @foreach($Ajitter as $row)
                    <p>{{ $row->ajitter }} ms</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MXjitter as $row)
                    <p>{{ $row->mxjitter }} ms</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MNjitter as $row)
                    <p>{{ $row->mnjitter }} ms</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($SDjitter as $row)
                    <p>{{ $row->sdjitter }} ms</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-2 border-right">
                <div class="card-header">
                    N
                </div>
                <div class="card-body">
                    @foreach($AC as $row)
                    <p>{{ $row->ac }}</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MXC as $row)
                    <p>{{ $row->mxc }}</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($MNC as $row)
                    <p>{{ $row->mnc }}</p>
                    @endforeach()
                    <br><br><br>
                    @foreach($SDC as $row)
                    <p>{{ $row->sdc }}</p>
                    @endforeach()
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <div class="col-4 center">
                <button role="button" class="btn btn-primary" onclick="window.location='{{route('pagination.index')}}'">View Data Table</button>
            </div>
            <div class="col-4 center">
                <button role="button" class="btn btn-primary" onclick="window.location='{{route('avgap.index')}}'">Average by AP</button>
            </div>
            <div class="col-4 center">
                <button role="button" class="btn btn-primary" onclick="window.location='{{route('avgsubnet.index')}}'">Average by Subnet</button>
            </div>
        </div>
        @endauth

        @guest
        <h1>Dashboard</h1>
        <p class="lead">Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection