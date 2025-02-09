<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="{{route('front.home')}}">Home </a>
    <a href="#about">About</a>
    <a href="#service">Services  </a>
    <a href="#vehicles">Our Vehicles</a>
    <a href="#testimonial">Testimonial</a>
    <a href="#contact">Contact</a>
    @guest
        <a href="{{route('login')}}">Login</a>
        <a href="{{route('registration')}}">Registration</a>
    @else
        <a href="{{route('dashboard')}}">Dashboard</a>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <a href="">Logout</a>
        </form>
    @endguest
</div>
<header>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="logo">
                        <a href="{{route('front.home')}}"><h1 style="color: #0f98f8; font-size: 35px; font-weight:bold">BD HOME MOVERS</h1></a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="right_bottun">
                        <button class="openbtn" onclick="openNav()"><img src="{{asset('front-assets/images/menu_icon.png')}}" alt="#"/> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
