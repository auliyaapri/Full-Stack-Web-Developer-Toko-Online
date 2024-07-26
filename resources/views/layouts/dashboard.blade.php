<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('title')</title>
  <link rel="icon" type="image/x-icon" href="/images/img_title.png">

  @stack('prepand-style')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="/style/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.css" integrity="sha512-OWGg8FcHstyYFwtjfkiCoYHW2hG3PDWwdtczPAPUcETobBJOVCouKig8rqED0NMLcT9GtE4jw6IT1CSrwY87uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
          <img src="/images/logo2.png" alt="" style="max-width: 150px">
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
          <a href="{{ route('dashboard-product') }}"
            class="list-group-item list-group-item-action {{ request()->is('dashboard/products*') ? 'active' : '' }}">My Products</a>

          <a href="{{ route('dashboard-transactions') }}"
            class="list-group-item list-group-item-action {{ request()->is('dashboard/transactions*') ? 'active' : '' }}">Transactions</a>

          <a href="{{ route('dashboard-settings-store') }}"
            class="list-group-item list-group-item-action {{ request()->is('dashboard/settings*') ? 'active' : '' }}">Store
            Settings</a>
          <a href="{{ route('dashboard-settings-account') }}"
            class="list-group-item list-group-item-action {{ request()->is('dashboard/account*') ? 'active' : '' }}">My Account</a>

          <a class="list-group-item list-group-item-action fw-bold" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> Log out
          </a>

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

                    <img
                    src="{{ Storage::url(Auth::user()->image_profile) != '/storage/' ? Storage::url(Auth::user()->image_profile) : '/images/user_wtihout_image.png' }}"
                    alt="Gambar Profil" class="img-fluid rounded-circle me-2"
                    style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                
                    Hi, {{Auth::user()->name}}

                  </a>
                  <div class="dropdown-menu">
                    <a href="{{ route('dashboard') }}" class="dropdown-item"><i class="fa fa-dashboard mr-2"></i>Dashboard</a> 
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('home') }}" class="dropdown-item"><i class="fa fa-home mr-2"></i>Back to Home</a> 
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out mr-2"></i>Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                
                </li>

                <li class="nav-item d-none d-lg-block">
                  <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-1 ">
                    @php
                    $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                    @endphp
                    @if($carts > 0)
                    <img src="/images/icon-cart-filled.svg" alt="" />
                    <div class="card-badge">{{ $carts }}</div>
                    @else
                    <img src="/images/icon-cart-empty.svg" alt="" />
                    @endif
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

  <!-- Form Logout -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  @stack('prepand-script')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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