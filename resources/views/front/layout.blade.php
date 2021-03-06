<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<title>موصوف</title>
	<meta charset="UTF-8">
	<meta name="description" content="الموصوف معاني معاجم">
	<meta name="keywords" content="الموصوف, معاني, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<!--<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">-->
    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/styleresponsive.css')}}"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    @stack('style')
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=607a10b5f4ad800018621493&product=inline-share-buttons" async="async"></script>
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
<style>
    body {
    /*max-width: 100%;*/
    overflow-x: hidden;
    font-family: 'Cairo', sans-serif;
 }

</style>
</head>
<body>

<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=607a10b5f4ad800018621493&product=inline-share-buttons" async="async"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v10.0" nonce="2mXI4za2"></script>


	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
{{--@include('front.includes.header');--}}
@include('front.includes.header1');
@yield('content');
@include('front.includes.footer');

	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/mixitup.min.js')}}"></script>
	<script src="{{asset('assets/js/circle-progress.min.js')}}"></script>
	<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
    <link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
    @stack('javascript')
</body>
</html>
