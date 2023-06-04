@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Edit Location Price</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Edit Location Price</a></li>
            </ul>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('location.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="tile-body">
                        {!! Form::model($locationPrice, ['method' => 'PATCH','route' => ['location-price.update', $locationPrice->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Pickup Point:</strong>
                                    <select name="pickup_point" id="" class="form-control">
                                        <option value="" selected disabled readonly="">Choose Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}" {{$location->id == $locationPrice->pickup_point ? 'selected' : '' }}>{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Where to:</strong>
                                    <select name="where_to" id="" class="form-control">
                                        <option value="" selected disabled readonly="">Choose Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}" {{$location->id == $locationPrice->where_to ? 'selected' : '' }}>{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    {!! Form::text('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
