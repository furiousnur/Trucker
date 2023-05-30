<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Trucker</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('front-assets/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('front-assets/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('front-assets/css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="{{asset('front-assets/images/fevicon.png')}}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('front-assets/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/fancybox.css')}}">
    <!-- Tweaks for older IEs-->
    {{--<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">--}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    @yield("extra-header-link")
</head>
<!-- body -->
<body class="main-layout">
<!-- header -->
@include('frontend.layouts.header')
<!-- end header inner -->
<!-- end header -->
@yield('content')
<!--  footer -->
@include('frontend.layouts.footer')
<!-- end footer -->
<!-- Javascript files-->
<script src="{{asset('front-assets/js/jquery.min.js')}}"></script>
<script src="{{asset('front-assets/js/popper.min.js')}}"></script>
<script src="{{asset('front-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('front-assets/js/jquery-3.0.0.min.js')}}"></script>
<!-- sidebar -->
<script src="{{asset('front-assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('front-assets/js/custom.js')}}"></script>
<script>
    function openNav() {
        document.getElementById("mySidepanel").style.width = "250px";
    }
    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }
</script>
</body>
</html>
