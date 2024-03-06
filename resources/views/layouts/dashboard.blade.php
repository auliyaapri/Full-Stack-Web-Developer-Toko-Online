<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('title')</title>
  @stack('prepand-style')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="/style/main.css" rel="stylesheet"> 
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
          <img src="/images/dashboard-store-logo.svg" alt="">
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
          <a href="{{ route('dashboard-product') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard/products*') ? 'active' : '' }}">My Products</a>
           
          <a href="{{ route('dashboard-transactions') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard/transactions') ? 'active' : '' }}">Transactions</a>
          
          <a href="{{ route('dashboard-settings-store') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard/settings*') ? 'active' : '' }}">Store Settings</a>          
          <a href="{{ route('dashboard-settings-account') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard/account*') ? 'active' : '' }}">My Account</a>
          <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
                  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <!-- <img src="images/icon-user.png" alt="" class="me-2 profile-picture"> -->
                    <img src="/images/icon-user.png" alt="" class="me-2 profile-picture" />
                    Hi, {{Auth::user()->name}}
                  </a>
                  <div class="dropdown-menu">
                    <a href="dashboard.html" class="dropdown-item">Dashboard</a>
                    <a href="dashboard-account.html" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="/" class="dropdown-item">Logout</a>
                  </div>
                </li>
                <li class="nav-item d-none d-lg-block">
                  <a href="#" class="nav-link d-lg-inline-block mt-2">
                    <img src="/images/icon-cart-filled.svg" alt="" />
                    <div class="card-badge">3</div>
                  </a>
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
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

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