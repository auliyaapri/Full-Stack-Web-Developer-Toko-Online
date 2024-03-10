<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    {{-- === STYLE === --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">      
    <link href="{{ url('style/auth/auth.css') }}" rel="stylesheet">
    <link href="{{ url('style/auth/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('style/auth/owl.carousel.min.css') }}" rel="stylesheet">

</head>

<body>
    <!-- === Navbar === -->
    

    <!-- === PAGE CONTENT === -->
    @yield('content')

    <!-- === FOOTER === -->
    
    
    <script src="{{ asset('style/auth/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('style/auth/popper.min.js') }}"></script>
    <script src="{{ asset('style/auth/bootstrap.min.js') }}"></script>    

    @stack('addon-script')

</body>

</html>