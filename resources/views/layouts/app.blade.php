<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    {{-- === STYLE === --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('prepand-style')
    @include('includes.style');
    @stack('addon-style')



    <style>
        .carousel-inner .carousel-item {
            transition: .5s;
        }
    </style>

</head>

<body>
    <!-- === Navbar === -->
        
    @include('includes.navbar')

    <!-- === PAGE CONTENT === -->
    @yield('content')

    <!-- === FOOTER === -->
    @include('includes.footer')

    <!-- === SCRIPT === -->
    @stack('prepand-script')
    @include('includes.script');
    @stack('addon-script')
</body>

</html>