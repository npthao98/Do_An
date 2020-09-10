<!DOCTYPE html>
<html lang="zxx">
<!-- lang="zxx" -->

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashi</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/muli.css') }}" type="text/css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_fashi_shop/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>

<body>

    @include('includes.header')

    @yield('content')

    @include('includes.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_fashi_shop/js/main.js') }}"></script>
</body>

</html>
