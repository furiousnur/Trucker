@extends('backend.layouts.layout')
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Add Payment</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Add Payment</a></li>
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
        <div class="row justify-content-start">
            <div class="col-md-8 offset-md-2">
                <div class="tile">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('booking.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="tile-body">
                        <form class="form-group" method="post" action="{{route('booking.bill.pay',$booking->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Payment Amount: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="amount" id="price" value="{{$booking->price}}" @if(auth()->user()->user_type != 'admin') readonly @endif required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Payment Date: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="date" class="form-control" name="payment_date" placeholder="Payment Date"  readonly required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Payment Type: <span style="color: red; font-size: 14px">*</span></strong>
                                        <select required name="payment_type" id="payment_type_id" class="form-control">
                                            <option value="" selected disabled readonly="">Choose Payment Type</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bkash">Bkash</option>
                                            <option value="Nagad">Nagad</option>
                                            <option value="Card">Card</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                <div class="col-xs-12 col-sm-12 col-md-12" id="bkash" style="display: none">
                                    <div class="form-group">
                                        <strong>Payment Bkash Number: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="p_bkash_number" id="price" placeholder="Passenger Bkash Number">
                                    </div>
                                    <div class="form-group">
                                        <strong>Ref Number: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="b_ref_number" id="price" placeholder="Payment Ref Number">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" id="nagad" style="display: none">
                                    <div class="form-group">
                                        <strong>Payment Nagad Number: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="p_nagad_number" id="price" placeholder="Passenger Nagad Number">
                                    </div>
                                    <div class="form-group">
                                        <strong>Ref Number: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="n_ref_number" id="price" placeholder="Payment Ref Number">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" id="card" style="display: none">
                                    <div class="form-group">
                                        <strong>Card Number: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="card_number" id="price" placeholder="Card Number">
                                    </div>
                                    <div class="form-group">
                                        <strong>Card Name: <span style="color: red; font-size: 14px">*</span></strong>
                                        <input type="text" class="form-control" name="card_name" id="price" placeholder="Card Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Review Here</strong>
                                        <textarea class="form-control" name="review" id="" cols="30" rows="10" placeholder="Write Review here about the serve....."></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('extra-script-link')
    <script>
        //payment Date Field
        var currentDate = new Date().toISOString().split('T')[0];
        document.getElementsByName("payment_date")[0].value = currentDate;
        document.getElementsByName("payment_date")[0].setAttribute("min", currentDate);
        document.getElementsByName("payment_date")[0].setAttribute("max", currentDate);

        //Payment System
        document.getElementById('payment_type_id').addEventListener('change', function (){
           var bkashDiv = this.value == 'Bkash' ? 'block' : 'none';
           document.getElementById('bkash').style.display = bkashDiv;

            var bkashDiv = this.value == 'Nagad' ? 'block' : 'none';
            document.getElementById('nagad').style.display = bkashDiv;

            var bkashDiv = this.value == 'Card' ? 'block' : 'none';
            document.getElementById('card').style.display = bkashDiv;
        });
    </script>
@endsection
