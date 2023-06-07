@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Location Price</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Location Price</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Location Price Management</h2>
                </div>
                @can('set-location-price')
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('location-price.create') }}"> Set Location Price</a>
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
                                                <th>Pickup Point</th>
                                                <th>Where to</th>
                                                <th>Price</th>
                                                @canany(['edit-location-price', 'delete-location-price'])
                                                    <th width="280px">Action</th>
                                                @endcanany
                                            </tr>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $value->pickup_point }}</td>
                                                    <td>{{ $value->where_to }}</td>
                                                    <td>{{ $value->price }}</td>
                                                    @canany(['edit-location-price', 'delete-location-price'])
                                                        <td>
                                                            @can('edit-location-price')
                                                                <a class="btn btn-primary" href="{{ route('location-price.edit',$value->id) }}">Edit</a>
                                                            @endcan
                                                            @can('delete-location-price')
                                                                {!! Form::open(['method' => 'DELETE','route' => ['location-price.destroy', $value->id],'style'=>'display:inline']) !!}
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
