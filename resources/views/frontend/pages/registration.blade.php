@extends('frontend.layouts.layout')
@section('extra-header-link')
    <style>
        .login_banner_main {
            background: url(../front-assets/images/banner.png);
            padding: 200px 0px 0px 0px;
            background-size: auto 100%;
            background-repeat: no-repeat;
            background-position: right top;
        }
        .titlepagelogin h2 {
            font-size: 50px;
            /*color: #0f98f8;*/
            color: #000000;
            font-weight: bold;
        }
        .signin{
            border: 1px solid #1d78cb;
        }
        .main_form {
             max-width: unset;
        }
    </style>
@endsection
@section('content')
    <!-- banner -->
    <section class="login_banner_main">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="row">
                            <div class="col-md-12 signin mx-auto">
                                <div class="titlepagelogin">
                                    <h2 style="text-align: center;"><i class="fa fa-lg fa-fw fa-user"></i>SIGN UP</h2>
                                </div>
                                <form method="POST" action="{{ route('register') }}" id="request" class="main_form p-4">
                                    @csrf
                                    <div class="form-group">
                                        <select name="type" class="form-control contactus @error('type') is-invalid @enderror" required id="userTypeAction">
                                            <option value="" disabled {{ !old('type') ? 'selected' : '' }}>Choose User Type</option>
                                            <option value="passenger" {{ old('type') == 'passenger' ? 'selected' : '' }}>Passenger</option>
                                            <option value="driver" {{ old('type') == 'driver' ? 'selected' : '' }}>Driver</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="userType" id="commonFields" style="display: none;">
                                        <div class="form-group">
                                            <input id="name" type="text" class="form-control contactus @error('name') is-invalid @enderror" required
                                                   name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Enter Your Name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control contactus @error('email') is-invalid @enderror" required
                                                   name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Enter Your Email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="phone_number" type="text" class="form-control contactus @error('phone_number') is-invalid @enderror" required
                                                   name="phone_number" value="{{ old('phone_number') }}" autocomplete="phone_number" autofocus placeholder="Enter Your Phone Number">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select name="gender" class="form-control contactus @error('gender') is-invalid @enderror" required value="{{ old('gender') }}" id="userTypeAction">
                                                <option value="" selected disabled readonly>Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control contactus @error('password') is-invalid @enderror" required
                                                   name="password" autocomplete="new-password" placeholder="Enter Your Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control contactus" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="userType" id="userPassenger" style="display: none;">
                                        <div class="form-group">
                                            <input id="nid" type="text" class="form-control contactus @error('nid') is-invalid @enderror"
                                                   name="nid" value="{{ old('nid') }}" autocomplete="nid" autofocus placeholder="Enter Your NID Number">
                                            @error('nid')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="userType" id="userDriver" style="display: none;">
                                        <div class="form-group">
                                            <input id="address" type="text" class="form-control contactus @error('address') is-invalid @enderror"
                                                   name="address" value="{{ old('address') }}" autocomplete="address" autofocus placeholder="Enter Your Address">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="dr_lic_num" type="text" class="form-control contactus @error('dr_lic_num') is-invalid @enderror"
                                                   name="dr_lic_num" value="{{ old('dr_lic_num') }}" autocomplete="dr_lic_num" autofocus placeholder="Enter Driving License Number">
                                            @error('dr_lic_num')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="veh_reg_num" type="text" class="form-control contactus @error('veh_reg_num') is-invalid @enderror"
                                                   name="veh_reg_num" value="{{ old('veh_reg_num') }}" autocomplete="veh_reg_num" autofocus placeholder="Enter Vehicle registration number">
                                            @error('veh_reg_num')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="dob" type="date" class="form-control contactus @error('dob') is-invalid @enderror"
                                                   name="dob" value="{{ old('dob') }}" autocomplete="dob" autofocus placeholder="Choose Date of Birth">
                                            @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="monthly_income" type="text" class="form-control contactus @error('monthly_income') is-invalid @enderror"
                                                   name="monthly_income" value="{{ old('monthly_income') }}" autocomplete="monthly_income" autofocus placeholder="Enter Your Monthly Income">
                                            @error('monthly_income')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="send_btn" type="submit"><i  class="fa fa-sign-in fa-lg fa-fw"></i>SIGN UP</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->
@endsection
@section('extra-script')
    <script>
        document.getElementById('userTypeAction').addEventListener('change', function () {
            var passenger = this.value == "passenger" ? 'block' : 'none';
            document.getElementById('userPassenger').style.display = passenger;
            var driver = this.value == "driver" ? 'block' : 'none';
            document.getElementById('userDriver').style.display = driver;
            if(passenger == 'block' || driver == 'block'){
                document.getElementById('commonFields').style.display = 'block';
            }
        });
    </script>
@endsection
