@extends('frontend.layouts.layout')
@section('content')
    <!-- banner -->
    <section class="banner_main">
        <div id="banner1" class="carousel slide banner_slide" data-ride="carousel">
            {{-- <ol class="carousel-indicators">
                <li data-target="#banner1" data-slide-to="0" class="active"></li>
                <li data-target="#banner1" data-slide-to="1"></li>
                <li data-target="#banner1" data-slide-to="2"></li>
            </ol> --}}
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container-fluid">
                        <div class="carousel-caption">
                            <div class="row">
                                <div class="col-md-7 col-lg-5">
                                    <div class="text-bg">
                                        <h1>Best Logistic Company</h1>
                                        <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has i</span>
                                        <a class="read_more" href="#">Contact Us</a>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-7">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ban_track">
                                                <figure><img src="{{ asset('front-assets/images/track.png') }}" alt="#"/></figure>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <form class="transfot" action="{{ route('front.home') }}" method="get">
                                                <div class="col-md-12">
                                                    <span>Professional Services</span>
                                                    <h3>Get your transport quote</h3>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 7px">
                                                    <select name="pickup_point" id="pickup_point" class="form-control">
                                                        <option value="" selected disabled>Choose Pickup Point</option>
                                                        @foreach($locations as $location)
                                                            <option value="{{ $location->id }}"
                                                                {{ request()->pickup_point == $location->id ? 'selected' : '' }}>
                                                                {{ $location->location_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 7px">
                                                    <select name="where_to" id="where_to" class="form-control">
                                                        <option value="" selected disabled>Choose Destination</option>
                                                        @foreach($locations as $location)
                                                            <option value="{{ $location->id }}"
                                                                {{ request()->where_to == $location->id ? 'selected' : '' }}>
                                                                {{ $location->location_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="get_now">Get Now quote</button>
                                                    <button type="reset" class="get_now clear_btn">Clear</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(isset($quotes) && count($quotes) > 0)
                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <div class="row" style="margin-top: 50px; background-color: rgb(202, 176, 61); padding: 10px">
                                        <div class="col-sm-12">
                                            <h1 style="text-align: center; color: white; font-weight: bold">Quotes List</h1>
                                            <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info" style="border: 1px solid black; color: black;">
                                                <thead>
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>No</th>
                                                        <th>Pickup Point</th>
                                                        <th>Where to</th>
                                                        <th>Truck Type</th>
                                                        <th>Truck Price</th>
                                                        <th>Total Cost (Include service charge)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($quotes as $key => $value)
                                                        <tr>
                                                            <td>
                                                                <input type="radio" name="selected_quote" value="{{ $value->id }}">
                                                            </td>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->pickup_point ?? 'N/A' }}</td>
                                                            <td>{{ $value->where_to ?? 'N/A' }}</td>
                                                            <td>{{ $value->settings_truck_key ? ucwords(str_replace('_', ' ', $value->settings_truck_key)) : 'N/A' }}</td>
                                                            <td>{{ $value->settings_truck_value ?? '0.00' }}</td>
                                                            <td>{{ $value->price ?? '0.00' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12">
                                            <h1 style="text-align: center; color: white; font-weight: bold">Others charge will be added, if you would like to include</h1>
                                            <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info" style="border: 1px solid black; color: black;">
                                                <thead>
                                                    <tr>
                                                        <th>Number of Persons</th>
                                                        <th>Per Person Rate</th>
                                                        <th>Total Person Cost</th>
                                                        <th>Packaging Charge</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 250px;">
                                                            <input type="number" id="numPersons" name="num_persons" class="form-control" min="1" value="1" oninput="calculateTotal()">
                                                        </td>
                                                        <td>
                                                            <span id="perPersonRate" data-rate="{{ $per_persion_rate->value }}">{{ $per_persion_rate->value }}</span>
                                                            <input type="hidden" name="per_person_rate" value="{{ $per_persion_rate->value }}">
                                                        </td>
                                                        <td>
                                                            <span id="totalCost">{{ $per_persion_rate->value }}</span>
                                                            <input type="hidden" id="totalCostInput" name="total_cost" value="{{ $per_persion_rate->value }}">
                                                        </td>
                                                        <td>
                                                            {{ $packaging_rate->value }}
                                                            <input type="checkbox" id="packaging_rate" style="width: 20px; height: 20px;" name="total_cost"
                                                                value="{{ $packaging_rate->value }}">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input type="hidden" name="passenger_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="trip_type" value="passenger">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="trip_date">Trip Date</label>
                                            <input type="date" id="trip_date" name="trip_date" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="trip_time">Trip Time</label>
                                            <input type="time" id="trip_time" name="trip_time" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="trip_type">Trip Type</label>
                                            <select name="trip_type" class="form-control" id="trip_type">
                                                <option value="Regular">Regular</option>
                                                <option value="Urgent">Urgent(10% will be added to the total)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="trip_type">Total Cost</label>
                                            <input type="number" id="total_cost" name="total_cost" class="form-control" readonly>
                                        </div>
                                        <div class="col-sm-12 text-center" style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a> --}}
        </div>
    </section>
    <!-- end banner -->
    <!-- about section -->
    <div id="about" class="about" @if(isset($quotes) && count($quotes) > 0) style="margin-top: 50px @endif">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2 style="text-align: center">About Us</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, There </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section -->
    <!-- service section -->
    <div id="service" class="service">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="titlepage">
                        <h2>Our Services</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, There </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="service_main">
                        <div class="service_box blu_colo">
                            <i><img src="{{asset('front-assets/images/ser1.png')}}" alt="#"/></i>
                            <h4>FLY ANYWHERE</h4>
                        </div>
                        <div class="service_box yelldark_colo">
                            <i><img src="{{asset('front-assets/images/ser2.png')}}" alt="#"/></i>
                            <h4>Cargo service</h4>
                        </div>
                        <div class="service_box yell_colo">
                            <i><img src="{{asset('front-assets/images/ser3.png')}}" alt="#"/></i>
                            <h4> COURIER SERVICES</h4>
                        </div>
                        <div class="service_box yelldark_colo">
                            <i><img src="{{asset('front-assets/images/ser4.png')}}" alt="#"/></i>
                            <h4>BOX STORAGE</h4>
                        </div>
                        <div class="service_box yell_colo">
                            <i><img src="{{asset('front-assets/images/ser5.png')}}" alt="#"/></i>
                            <h4>100% safe</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <a class="read_more" href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end service section -->
    <!-- vehicles section -->
    <section id="vehicles" class="vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Vehicles</h2>
                        <p>nternet. It uses a dictionary of over 200 Latin words, combined with .</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="veh" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#veh" data-slide-to="0" class="active"></li>
                <li data-target="#veh" data-slide-to="1"></li>
                <li data-target="#veh" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc1.png')}}" alt="#"/></figure>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc2.png')}}" alt="#"/></figure>
                                    </div>
                                    <h3 class="blac_co">Truck</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc3.png')}}" alt="#"/></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc1.png')}}" alt="#"/></figure>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc2.png')}}" alt="#"/></figure>
                                    </div>
                                    <h3 class="blac_co">Truck</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc3.png')}}" alt="#"/></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="carousel-caption">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc1.png')}}" alt="#"/></figure>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc2.png')}}" alt="#"/></figure>
                                    </div>
                                    <h3 class="blac_co">Truck</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="vehicles_truck">
                                        <figure><img src="{{asset('front-assets/images/truc3.png')}}" alt="#"/></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#veh" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#veh" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a class="read_more" href="#">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end vehicles section -->
    <!-- testimonial section -->
    <div id="testimonial" class="testimonial bottom_cross bottom_cross2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Testimonials</h2>
                        <p>nternet. It uses a dictionary of over 200 Latin words, combined with .</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide testimonial_Carousel " data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="carousel-caption ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="testimonial_box">
                                                    <h3>Luda Johnson <br><span class="kisu">( Ceo)</span></h3>
                                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 year</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="testimonial_box">
                                                    <h3>Luda Johnson <br><span class="kisu">( Ceo)</span></h3>
                                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 year</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="full cross_layout">
                                                    <div class="testimonial_box">
                                                        <h3>Luda Johnson <br><span class="kisu">( Ceo)</span></h3>
                                                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 year</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="read_more" href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonial section -->
    <!-- choose section -->
    <div class="choose">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Why Choose Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="choose_box">
                        <i><img src="{{asset('front-assets/images/why1.png')}}" alt="#"/></i>
                        <h3>Our Vission</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                        <a class="read_more" href="#">Read More</a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="choose_box">
                        <i><img src="{{asset('front-assets/images/why2.png')}}" alt="#"/></i>
                        <h3>Estimate Shipping</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                        <a class="read_more" href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end choose section -->
    <!-- contact section -->
    <div id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Requst A call  for You</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="con_bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <form id="request" class="main_form">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <input class="contactus" placeholder="Name" type="type" name="Name">
                                </div>
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="Email" type="type" name="Email">
                                </div>
                                <div class="col-md-12">
                                    <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">
                                </div>
                                <div class="col-md-12">
                                    <input class="contactusmess" placeholder="Message" type="type" Message="Name">
                                </div>
                                <div class="col-md-12">
                                    <button class="send_btn">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <div class="co_tru">
                            <figure><img src="{{asset('front-assets/images/truc4.png')}}" alt="#"/></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact section -->
@endsection
@section("extra-script")
<script>
    $(document).ready(function () {
        $('#pickup_point').on('change', function () {
            var pickupId = $(this).val();
            $('#where_to').html('<option value="" selected disabled>Loading...</option>');
            if (pickupId) {
                $.ajax({
                    url: "{{ route('get.destinations', '') }}/" + pickupId, // Laravel route
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('#where_to').html('<option value="" selected disabled>Choose Destination</option>');
                        $.each(response, function (key, location) {
                            $('#where_to').append('<option value="' + location.id + '">' + location.location_name + '</option>');
                        });
                    },
                    error: function () {
                        $('#where_to').html('<option value="" selected disabled>Error loading destinations</option>');
                    }
                });
            }
        });
    });
    document.querySelector('.clear_btn').addEventListener('click', function() {
        window.location.replace('/');
    });
    function calculateTotal() {
        let numPersons = document.getElementById('numPersons').value;
        let perPersonRate = document.getElementById('perPersonRate').getAttribute('data-rate');
        let totalCost = numPersons * perPersonRate;
        document.getElementById('totalCost').innerText = totalCost.toFixed(2);
    }
    document.addEventListener("DOMContentLoaded", function () {
        function calculateTotal() {
            let selectedQuote = document.querySelector('input[name="selected_quote"]:checked');
            let numPersons = parseInt(document.getElementById("numPersons").value) || 1;
            let perPersonRate = parseFloat(document.getElementById("perPersonRate").dataset.rate) || 0;
            let packagingCharge = document.getElementById("packaging_rate").checked
                                    ? parseFloat(document.getElementById("packaging_rate").value) || 0
                                    : 0;
            let tripType = document.getElementById("trip_type").value;
            let urgentCharge = 0;

            // Get the selected quote's total price
            let selectedPrice = 0;
            if (selectedQuote) {
                let row = selectedQuote.closest("tr");
                selectedPrice = parseFloat(row.querySelector("td:nth-child(7)").textContent) || 0;
            }

            // Calculate total person cost
            let totalPersonCost = numPersons * perPersonRate;

            // Calculate base total
            let baseTotal = selectedPrice + totalPersonCost + packagingCharge;

            // Apply urgent charge (10% extra)
            if (tripType === "Urgent") {
                urgentCharge = baseTotal * 0.10;
            }

            // Final total cost
            let finalTotal = baseTotal + urgentCharge;

            // Update the total cost field
            document.getElementById("total_cost").value = finalTotal.toFixed(2);
        }

        // Event listeners for instant calculation
        document.querySelectorAll('input[name="selected_quote"]').forEach(radio => {
            radio.addEventListener("change", calculateTotal);
        });

        document.getElementById("numPersons").addEventListener("input", calculateTotal);
        document.getElementById("packaging_rate").addEventListener("change", calculateTotal);
        document.getElementById("trip_type").addEventListener("change", calculateTotal);
    });
</script>
@endsection

