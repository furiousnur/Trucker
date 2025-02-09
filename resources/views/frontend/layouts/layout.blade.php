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
    <title>BD HOME MOVERS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="{{asset('front-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/responsive.css')}}">
    <link rel="icon" href="{{asset('front-assets/images/fevicon.png')}}" type="image/gif" />
    <link rel="stylesheet" href="{{asset('front-assets/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/fancybox.css')}}">
    @yield("extra-header-link")
</head>
<body class="main-layout">
@include('frontend.layouts.header')
@yield('content')
@include('frontend.layouts.footer')
<script src="{{asset('front-assets/js/jquery.min.js')}}"></script>
<script src="{{asset('front-assets/js/popper.min.js')}}"></script>
<script src="{{asset('front-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('front-assets/js/jquery-3.0.0.min.js')}}"></script>
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
@yield("extra-script")
</body>
</html>
