@extends('layouts.auth_baru')

@section('title')
Login
@endsection


@section('content')
<div class="d-lg-flex half">
  <div class="bg order-1 order-md-2" style="background-image: url('/images/surface-91HFUXYi_Jg-unsplash.jpg');"></div>
  <div class="contents order-2 order-md-1">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <img src="" alt="">
        <div class="col-md-7">

          <h3>Login to <strong>Wiguna Online Store</strong></h3>
          <p class="mb-4 text-dark">Silakan login untuk mulai menikmati berbagai penawaran menarik di Wiguna Online Store.</p>
          <form action="{{route('login')}}" method="POST" class="mt-3">
            @csrf
            <div class="form-group first">
              <label for="email">Email</label>
              <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group last mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                required autocomplete="current-password" id="myInput">
              <input type="checkbox" onclick="myFunction()" class="mt-3"><span class="pl-2">Show Password</span>

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="d-flex align-items-center">
              <span class="ml-auto"><a href="{{route('register')}}" class="forgot-pass">Belum punya akun ?
                  Register</a></span>
            </div>
            <button class="btn btn-block btn-primary mt-3"> Login </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


<SCript>
  function myFunction() {
var x = document.getElementById("myInput");
if (x.type === "password") {
  x.type = "text";
} else {
  x.type = "password";
}
}
</SCript>