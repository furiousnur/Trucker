@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Location</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Location</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Location List</h2>
                </div>
                @can('add-location')
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('location.create') }}"> Create New Location</a>
                    </div>
                @endcan
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
                                                <th>Location Name</th>
                                                @canany(['edit-location', 'delete-location'])
                                                    <th width="280px">Action</th>
                                                @endcanany
                                            </tr>
                                            @foreach ($data as $key => $location)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $location->location_name }}</td>
                                                    @canany(['edit-location', 'delete-location'])
                                                        <td>
                                                            @can('edit-location')
                                                                <a class="btn btn-primary" href="{{ route('location.edit',$location->id) }}">Edit</a>
                                                            @endcan
                                                            @can('delete-location')
                                                                {!! Form::open(['method' => 'DELETE','route' => ['location.destroy', $location->id],'style'=>'display:inline']) !!}
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
