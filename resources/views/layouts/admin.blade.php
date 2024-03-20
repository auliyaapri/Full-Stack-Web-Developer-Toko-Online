<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" href="/images/administrator.png">
  <title>@yield('title')</title>
  @stack('prepand-style')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="/style/main.css" rel="stylesheet"> 
  {{-- <link href="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.css" rel="stylesheet">  --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  @stack('addon-style')
  
  <style>
    .carousel-inner .carousel-item {
      transition: .5s;
    }
  </style>
</head>

<body>
  
  <div class="page-dashboard">
    <div class="d-flex" id="wrapper" data-aos="fade-right">
      <!-- sidebar -->
      <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
          <img src="/images/logo2.png" alt="" class="" style="max-width: 150px">
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('admin-dashboard') }}" class="list-group-item list-group-item-action {{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>                
          <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/product*') && !request()->is('admin/product-gallery*') ? 'active' : '' }}">Products</a>
          <a href="{{ route('product-gallery.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/product-gallery*') ? 'active' : '' }}">Product Gallery</a>        
          {{-- <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/category') || request()->is('admin/category/create') || request()->is('admin/category/1/edit') ? 'active' : '' }}">Categories</a> --}}
          <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">Categories</a>        
          <a href="{{ route('store.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/store*') || request()->is('store*')) ? 'active' : '' }}">Store Customer</a>
          <a href="{{ route('transaction.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/transaction*') ? 'active' : '' }}">Transaction</a>
          <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action  {{ request()->is('admin/user*') ? 'active' : '' }}">Users</a>
          <a class="list-group-item list-group-item-action fw-bold" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i> Log out </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>

      <!-- Page Content -->
      <div id="page-content-wrapper">
        {{-- === Navbar === --}}
        <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
          <div class="container-fluid">
            <button class="btn btn-secondary d-md-none me-auto me-2" id="menu-toggle">
              &laquo; Menu
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <!-- ===== DESKTOP MENU ===== -->
              <ul class="navbar-nav d-none d-lg-flex ms-auto">
                <li class="nav-item dropdown">
                  {{-- <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown"> --}}
                    <!-- <img src="images/icon-user.png" alt="" class="me-2 profile-picture"> -->
                    <img src="/images/icon-user.png" alt="" class="me-2 profile-picture" />
                    Hi, {{Auth::user()->name}}
                  </a>
                  {{-- <div class="dropdown-menu">                                        
                    <a href="/" class="dropdown-item">Logout</a>
                  </div> --}}
                </li> 
              </ul>
              <!-- ===== MOBILE MENU ===== -->
              <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                  <a href="" class="nav-link"> Hi, Angga </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link d-inline-block"> Cart </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        
        {{-- === Content === --}}
        @yield('content')

      </div>
    </div>
  </div>


  @stack('prepand-script')  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  {{-- === DATA TABLES === --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script>
      $("#datatable").DataTable();
    </script>
  {{-- === DATA TABLES === --}}

  {{-- === AOS === --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  {{-- === AOS === --}}

  <!-- Menu Button Mobile -->
  <script>
    $('#menu-toggle').on('click', function (e) {
      e
    .preventDefault(); // mencegah agar halaman tidak melakukan reload atau aksi default lainnya saat elemen #menu-toggle diklik.
      $('#wrapper').toggleClass('toggled')
    });
  </script>
    @stack('addon-script')


</body>




</html>


