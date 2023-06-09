@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Total User</h4>
                        <p><b>{{$totalUser}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Total Passenger</h4>
                        <p><b>{{$totalPassenger}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Total Driver</h4>
                        <p><b>{{$totalDriver}}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-location-arrow fa-3x"></i>
                    <div class="info">
                        <h4>Total Location</h4>
                        <p><b>{{$totalLocation}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
