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
            <h3>Average Jumbo Speed</h3>
            <div class="col-3 border-right">
                <div class="card-header">
                    Download
                </div>
                <div class="card-body">
                    @foreach($Adownload as $row)
                    <p>{{ $row->adl }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Upload
                </div>
                <div class="card-body">
                    @foreach($Aupload as $row)
                    <p>{{ $row->aul }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Ping
                </div>
                <div class="card-body">
                    @foreach($Aping as $row)
                    <p>{{ $row->aping }} ms</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Jitter
                </div>
                <div class="card-body">
                    @foreach($Ajitter as $row)
                    <p>{{ $row->ajitter }} ms</p>
                    @endforeach()
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <h3>Max Jumbo Speed</h3>
            <div class="col-3 border-right">
                <div class="card-header">
                    Download
                </div>
                <div class="card-body">
                    @foreach($MXdownload as $row)
                    <p>{{ $row->mxdl }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Upload
                </div>
                <div class="card-body">
                    @foreach($MXupload as $row)
                    <p>{{ $row->mxul }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Ping
                </div>
                <div class="card-body">
                    @foreach($MXping as $row)
                    <p>{{ $row->mxping }} ms</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Jitter
                </div>
                <div class="card-body">
                    @foreach($MXjitter as $row)
                    <p>{{ $row->mxjitter }} ms</p>
                    @endforeach()
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <h3>Min Jumbo Speed</h3>
            <div class="col-3 border-right">
                <div class="card-header">
                    Download
                </div>
                <div class="card-body">
                    @foreach($MNdownload as $row)
                    <p>{{ $row->mndl }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Upload
                </div>
                <div class="card-body">
                    @foreach($MNupload as $row)
                    <p>{{ $row->mnul }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Ping
                </div>
                <div class="card-body">
                    @foreach($MNping as $row)
                    <p>{{ $row->mnping }} ms</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Jitter
                </div>
                <div class="card-body">
                    @foreach($MNjitter as $row)
                    <p>{{ $row->mnjitter }} ms</p>
                    @endforeach()
                </div>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <h3>SD Jumbo Speed</h3>
            <div class="col-3 border-right">
                <div class="card-header">
                    Download
                </div>
                <div class="card-body">
                    @foreach($SDdownload as $row)
                    <p>{{ $row->sddl }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Upload
                </div>
                <div class="card-body">
                    @foreach($SDupload as $row)
                    <p>{{ $row->sdul }} Mbps</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Ping
                </div>
                <div class="card-body">
                    @foreach($SDping as $row)
                    <p>{{ $row->sdping }} ms</p>
                    @endforeach()
                </div>
            </div>
            <div class="col-3 border-right">
                <div class="card-header">
                    Jitter
                </div>
                <div class="card-body">
                    @foreach($SDjitter as $row)
                    <p>{{ $row->sdjitter }} ms</p>
                    @endforeach()
                </div>
            </div>
        </div>
        <br>
        <div class="d-grid gap-2 col-2 mx-auto">
            <button role="button" class="btn btn-primary" onclick="window.location='{{route('pagination.index')}}'">View Data Table</button>
            <button role="button" class="btn btn-primary" onclick="window.location='{{route('avgap.index')}}'">Average by AP</button>
            <button role="button" class="btn btn-primary" onclick="window.location='{{route('avgsubnet.index')}}'">Average by Subnet</button>
        </div>
        @endauth

        @guest
        <h1>Dashboard</h1>
        <p class="lead">Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection