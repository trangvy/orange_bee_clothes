<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Basic page needs -->

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> @yield('title')</title>
        <link rel="shortcut icon" href="#">
        <!-- Fonts -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!-- Main CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/meanmenu.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('rs-plugin/css/settings.css') }}" media="screen" />
    </head><!--/head-->

    <body class="vsc-initialized">
        <!--/header-->
        @include("layouts.elements.header")

        @include("layouts.elements.leftsidebar")
        
        @include("layouts.elements.footer")
        <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ asset('js/price-slider.js') }}"></script>
        <script src="{{ asset('js/jquery.elevatezoom.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.countdown.js') }}"></script>
        <script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
        <script src="{{ asset('rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{ asset('rs-plugin/js/rs.home.js') }}"></script>

        <script src="{{ asset('js/main.js') }}"></script>
        @yield('js')
    </body>
</html>