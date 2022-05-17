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
        <div class="d-grid gap-2 col-2 mx-auto">
            <button role="button" class="btn btn-primary" onclick="window.location='{{route('pagination.index')}}'">View Data Table</button>
        </div>
        @endauth

        @guest
        <h1>Dashboard</h1>
        <p class="lead">Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection