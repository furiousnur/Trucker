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
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('booking.create') }}"> New Booking</a>
                </div>
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
                                                <th>Passenger Name</th>
                                                <th>Driver Name</th>
                                                <th>Trip Type</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Pickup Point</th>
                                                <th>Where to</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th width="130px">Action</th>
                                            </tr>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $value->passenger_name }}</td>
                                                    <td>{{ $value->driver_name }}</td>
                                                    <td>{{ $value->trip_type }}</td>
                                                    <td>{{ $value->trip_date }}</td>
                                                    <td>{{ $value->trip_time }}</td>
                                                    <td>{{ $value->pickup_point ?? '' }}</td>
                                                    <td>{{ $value->where_to ?? ''}}</td>
                                                    <td>{{ $value->price }}</td>
                                                    <td>
                                                        @if($value->status == 0)
                                                            <span class="badge badge-primary">Pending</span>
                                                        @elseif($value->status == 1)
                                                            <span class="badge badge-info">Accept</span>
                                                        @elseif($value->status == 2)
                                                            <span class="badge badge-danger">Reject</span>
                                                        @elseif($value->status == 3)
                                                            <span class="badge badge-success">Success</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary" href="{{ route('booking.edit',$value->id) }}">Edit</a>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['booking.destroy', $value->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
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
