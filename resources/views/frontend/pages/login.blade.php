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
            color: #0f98f8;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <!-- banner -->
    <section class="login_banner_main">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 offset-4">
                        <div class="titlepagelogin">
                            <h2 style="text-align: center;"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h2>
                        </div>
                        <form method="POST" action="{{ route('login') }}" id="request" class="main_form">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control contactus @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password"
                                       class="form-control contactus @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="send_btn"><i  class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->
@endsection
