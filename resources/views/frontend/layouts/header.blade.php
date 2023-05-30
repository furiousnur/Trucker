<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="{{route('front.home')}}">Home </a>
    <a href="#about">About</a>
    <a href="#service">Services  </a>
    <a href="#vehicles">Our Vehicles</a>
    <a href="#testimonial">Testimonial</a>
    <a href="#contact">Contact</a>
    <a href="{{route('login')}}">Login</a>
    <a href="{{route('registration')}}">Registration</a>
</div>
<header>
    <!-- header inner -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="logo">
{{--                        <a href="index.html"><img src="{{asset('front-assets/images/logo.png')}}" alt="#" /></a>--}}
                        <a href="{{route('front.home')}}"><h1 style="color: #0f98f8; font-size: 35px; font-weight:bold">TRUCKER</h1></a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="right_bottun">
                       {{-- <ul class="conat_info d_none ">
                            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                        </ul>--}}
                        <button class="openbtn" onclick="openNav()"><img src="{{asset('front-assets/images/menu_icon.png')}}" alt="#"/> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
