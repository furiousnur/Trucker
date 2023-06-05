@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Add Booking</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Add Booking</a></li>
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
        <div id="errorMsg" style="display: none;">
            <p class="text-danger">Where to Location Not Found</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('booking.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="tile-body">
                        {!! Form::open(array('route' => 'booking.store','method'=>'POST')) !!}
                        <div class="row">
                            @if(auth()->user()->user_type == 'admin')
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Passenger:</strong>
                                        <select required name="passenger_id" id="" class="form-control">
                                            <option value="" selected disabled readonly="">Choose Passenger</option>
                                            @foreach($passengers as $passenger)
                                                <option value="{{$passenger->id}}">{{$passenger->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="passenger_id" value="{{auth()->id()}}">
                            @endif

                            <div class="col-xs-12 col-sm-12 col-md-{{auth()->user()->user_type == 'admin' ? 6 : 12}}">
                                <div class="form-group">
                                    <strong>Driver:</strong>
                                    <select required name="pickup_point" id="" class="form-control">
                                        <option value="" selected disabled readonly="">Choose Driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Pickup Point:</strong>
                                    <select required name="pickup_point" id="pickup_point_id" class="form-control">
                                        <option value="" selected disabled readonly="">Choose Location</option>
                                        @foreach($pickupPoints as $location)
                                            <option value="{{$location->id}}">{{$location->pickup_point}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Where to:</strong>
                                    <select required name="where_to" id="where_to_id" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Trip Type:</strong>
                                    <select required name="trip_type" id="" class="form-control">
                                        <option value="" selected disabled readonly="">Choose Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Schedule">Schedule</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Trip Date:</strong>
                                    <input type="date" class="form-control" name="trip_date" placeholder="Choose Trip Date" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Time:</strong>
                                    <input type="time" class="form-control" name="trip_time" placeholder="Choose Trip Time" required>
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
@section('extra-script-link')
    <script>
        document.getElementById('pickup_point_id').addEventListener('change', function () {
            var pickup_point_id = document.getElementById('pickup_point_id').value;
            $.ajax({
                url:"{{url('where-to-locations')}}/"+pickup_point_id,
                type: "get",
                data: { },
                success: function(response) {
                    if(response == 'Location Not Found.'){
                        document.getElementById('errorMsg').style.display = 'block';
                        $("#errorMsg").html();
                    }else{
                        document.getElementById('errorMsg').style.display = 'none';
                        var select = $('#where_to_id');
                        select.empty();
                        $.each(response, function(index, option) {
                            select.append($('<option value="" selected disabled readonly="">Choose Location</option>'));
                            select.append($('<option></option>').attr('value', option.where_to).text(option.location_name));
                        });
                    }
                }
            });
        });
        document.getElementById('where_to_id').addEventListener('change', function () {
            var where_to_id = document.getElementById('where_to_id').value;
            var pickup_point_id = document.getElementById('pickup_point_id').value;
            $.ajax({
                url:"{{url('where-to-price')}}/"+where_to_id+"/"+pickup_point_id,
                type: "get",
                data: { },
                success: function(response) {
                    document.getElementById('price').value = response.price;
                }
            });
        });
    </script>
@endsection
