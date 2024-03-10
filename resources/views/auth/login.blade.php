@extends('layouts.auth_baru')
  @section('content')
  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('https://plus.unsplash.com/premium_photo-1709310749440-bfcae3e84c7e?q=80&w=2012&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">

            <h3>Login to <strong>Colorlib</strong></h3>
            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
            <form action="{{route('login')}}" method="POST" class="mt-3">
            @csrf
              <div class="form-group first">
                <label for="email">Email</label>                
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group last mb-3">
                <label for="password">Password</label>                
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
              <div class="d-flex mb-5 align-items-center">          
                <span class="ml-auto"><a href="{{route('register')}}" class="forgot-pass">Belum punya akun ? Register</a></span> 
              </div>
              <button class="btn btn-block btn-primary"> Login </button>
            </form>
          </div>
        </div>
      </div>
    </div>  
  </div>
  @endsection
