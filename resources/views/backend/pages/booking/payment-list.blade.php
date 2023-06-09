@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Payment List</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Payment List</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Payment List</h2>
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
                                                <th>Driver Info</th>
                                                <th>Passenger Info</th>
                                                <th>Trip Type</th>
                                                <th>Pickup Point</th>
                                                <th>Where to</th>
                                                <th>Amount</th>
                                                <th>Payment Date</th>
                                                <th>Payment Type</th>
                                                <th>Status</th>
                                                <th>Review</th>
                                            </tr>
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>
                                                        <span>Name: {{ $value->driver_name }}</span><br>
                                                        <span>Number: {{ $value->driver_number }}</span>
                                                    </td>
                                                    <td>
                                                        <span>Name: {{ $value->passenger_name }}</span><br>
                                                        <span>Number: {{ $value->passenger_number }}</span>
                                                    </td>
                                                    <td>{{ $value->trip_type }}</td>
                                                    <td>{{ $value->pickup_point ?? '' }}</td>
                                                    <td>{{ $value->where_to ?? ''}}</td>
                                                    <td>{{ $value->price }}</td>
                                                    <td>{{ $value->payment_date }}</td>
                                                    <td>
                                                        <span class="badge badge-info">{{ $value->payment_type }}</span>
                                                        @if($value->payment_type == 'Bkash')
                                                            <br>
                                                            <span>Bkash Number: {{$value->p_bkash_number}}</span><br>
                                                            <span>Ref Number: {{$value->b_ref_number}}</span>
                                                        @elseif($value->payment_type == 'Nagad')
                                                            <br>
                                                            <span>Nagad Number: {{$value->p_nagad_number}}</span><br>
                                                            <span>Ref Number: {{$value->n_ref_number}}</span>
                                                        @elseif($value->payment_type == 'Card')
                                                            <br>
                                                            <span>Card Number: {{$value->card_number}}</span><br>
                                                            <span>Card Name: {{$value->card_name}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($value->booking_status == 6)
                                                            <span class="badge badge-success">Payment Success</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->review ?? ""}}</td>
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
