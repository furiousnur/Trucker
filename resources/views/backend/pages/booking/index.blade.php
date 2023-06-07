@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Booking List</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Booking List</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Booking List Management</h2>
                </div>
                @can('add-booking')
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('booking.create') }}"> New Booking</a>
                    </div>
                @endif
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <div id="sampleTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover table-bordered dataTable no-footer"
                                               id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                                            <tr>
                                                <th>No</th>
                                                @if(auth()->user()->user_type == 'driver')
                                                    <th>Passenger Name</th>
                                                @endif
                                                @if(auth()->user()->user_type == 'passenger')
                                                    <th>Driver Name</th>
                                                @endif
                                                <th>Trip Type</th>
                                                <th>Pickup Point</th>
                                                <th>Where to</th>
                                                <th>Price</th>
                                                <th>Contact Number</th>
                                                <th>Trip Date</th>
                                                <th>Trip Time</th>
                                                <th>Status</th>
                                                @canany(['accept-booking', 'reject-booking', 'delete-booking'])
                                                    <th width="{{auth()->user()->user_type == 'admin' ? 220 : 150}}px">Action</th>
                                                @endcanany
                                            </tr>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    @if(auth()->user()->user_type == 'driver')
                                                        <td>{{ $value->passenger_name }}</td>
                                                    @endif
                                                    @if(auth()->user()->user_type == 'passenger')
                                                        <td>{{ $value->driver_name }}</td>
                                                    @endif
                                                    <td>{{ $value->trip_type }}</td>
                                                    <td>{{ $value->pickup_point ?? '' }}</td>
                                                    <td>{{ $value->where_to ?? ''}}</td>
                                                    <td>{{ $value->price }}</td>
                                                    <td>
                                                        @if(auth()->user()->user_type == 'driver')
                                                            {{ $value->passenger_number }}
                                                        @elseif(auth()->user()->user_type == 'passenger')
                                                            {{ $value->driver_number }}
                                                        @else
                                                            <span>Driver: {{ $value->driver_number }}</span><br>
                                                            <span>Passenger: {{ $value->passenger_number }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->trip_date }}</td>
                                                    <td>{{ $value->trip_time }}</td>
                                                    <td>
                                                        @if($value->status == 0)
                                                            <span class="badge badge-primary">Pending</span>
                                                        @elseif($value->status == 1)
                                                            <span class="badge badge-info">Accept</span>
                                                        @elseif($value->status == 2)
                                                            <span class="badge badge-danger">Reject</span>
                                                        @elseif($value->status == 3)
                                                            <span class="badge badge-success">Running</span>
                                                        @elseif($value->status == 4)
                                                            <span class="badge badge-success">Success</span>
                                                        @elseif($value->status == 5)
                                                            <span class="badge badge-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    @canany(['accept-booking', 'reject-booking', 'delete-booking', 'cancel-booking'])
                                                        <td>
                                                            @if($value->status == 0)
                                                                @can('cancel-booking')
                                                                    <a class="btn btn-danger" href="{{ route('booking.tripStatus',[$value->id, 5]) }}">Cancel</a>
                                                                @endcan
                                                                @can('accept-booking')
                                                                    <a class="btn btn-primary" href="{{ route('booking.tripStatus',[$value->id, 1]) }}">Accept</a>
                                                                @endcan
                                                                @can('reject-booking')
                                                                    <a class="btn btn-danger" href="{{ route('booking.tripStatus',[$value->id, 2]) }}">Reject</a>
                                                                @endcan
                                                            @elseif($value->status == 1 && auth()->user()->user_type != 'passenger')
                                                                <a class="btn btn-primary" href="{{ route('booking.tripStatus',[$value->id, 3]) }}">Trip Start</a>
                                                            @elseif($value->status == 3 && auth()->user()->user_type != 'passenger')
                                                                <a class="btn btn-primary" href="{{ route('booking.tripStatus', [$value->id, 4]) }}">Trip Finish</a>
                                                            @endif
                                                            @can('delete-booking')
                                                                {!! Form::open(['method' => 'DELETE','route' => ['booking.destroy', $value->id],'style'=>'display:inline']) !!}
                                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                                {!! Form::close() !!}
                                                            @endcan
                                                        </td>
                                                    @endcanany
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! $data->render() !!}
    </main>
@endsection
