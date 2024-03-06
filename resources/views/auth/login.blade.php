@extends('layouts.auth')

@section('content')
<div class="page-content page-auth">
  <section class="section-store-auth" data-aos="fade-up">
    <div class="container">
      <div class="row align-items-center row-login">
        <div class="col-lg-6 text-center">
          <img src="/images/login-placeholder.png" class="w-50 mb-4 mb-lg-none" alt="">
        </div>
        <div class="col-lg-5">
          <h2>Belanja kebutuhan utama, menjadi lebih mudah</h2>
          {{-- Form --}}
          <form action="{{route('login')}}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" id="email" class="form-control w-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            {{-- === PASSWORD === --}}
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" id="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <button class="btn btn-success btn-block w-75 mt-4">
              Sign In to My Account
            </button>
            <a href="{{route('register')}}" class="btn btn-signup btn-block w-75 mt-4">
              Sign Up
            </a>
          </form>
        </div>
      </div>
    </div>

  </section>
</div>
@endsection