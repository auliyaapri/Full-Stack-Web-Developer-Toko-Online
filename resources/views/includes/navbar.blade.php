<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-store navbar-fixed-top fixed-top" data-aos="fade-down">
  <div class="container">
    <a class="navbar-brand" href="/index.html">
      <img src="/images/logo.svg" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
      aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="{{ url('categories') }}">Categories</a>
        </li>
        <li class="nav-item">          
          <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ url('products') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Rewards</a>
        </li>
        <!-- Jika Belum Login -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/register') }}">Sign Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-success text-white px-4" href="{{ url('/login') }}">Sign In</a>
        </li>
        @endguest
        <!-- Jika Sudah Login -->
        @auth
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <img src="images/icon-user.png" alt="" class="me-2 profile-picture" />
            Hi, {{ Auth::user()->name }}

          </a>
          <div class="dropdown-menu">
            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
            {{-- <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">Settings</a> --}}
            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

          {{-- <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('dashboard') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-car"></i> <span class="ps-2">Ldsdsog out </span> </a>
          </div> --}}

          <div class="dropdown-menu"><h1>sdsdsd</h1></div>


        </li>
        <li class="nav-item d-none d-lg-block">          
            <a href="{{ route('cart') }}" class="nav-link d-inline-block">
            @php
                $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
            @endphp        
            @if ($carts > 0)
              <img src="images/icon-cart-empty.svg" alt="" class="" />
              <div class="card-badge">{{$carts}}</div>
            @else 
              <img src="images/icon-cart-empty.svg" alt="" class="" />

            @endif
          </a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Form Logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

