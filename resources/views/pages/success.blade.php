@extends('layouts.success')

@section('title')
Success Cart Page
@endsection

@section('content')
<div class="page-content page-success">
  <section class="section-success" data-aos="zoom-in">
    <div class="container">
      <div class="row align-items-center row-login justify-content-center">
        <div class="col-lg-6 text-center">
          
          <img src="{{url('images/success.svg')}}" alt="" class="mb-4">
          <h2>
            Transaction Processed!
          </h2>
          <p>
            Silahkan tunggu konfirmasi email dari kami dan <br>
            kami akan menginformasikan resi secept mungkin!
          </p>
          <div>
            <a href="/dashboard.html" class="btn btn-success w-50 mt-4">My Dashboard</a>
            <a href="{{url ('/')}}" class="btn btn-signup w-50 mt-2">Go to Shopping</a>
          </div>
        </div>

      </div>
    </div>

  </section>
</div>
@endsection