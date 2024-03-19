@extends('layouts.dashboard')

@section('title')
Store Dashboard Product
@endsection

@section('content')
<section class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Transactions</h2>
      <p class="dashboard-subtitle">Big result start from the small one</p>
    </div>
    <!-- Dashboard Content -->
    <div class="dashboard-content">
      <div class="row mt-3">
        <div class="col-12 mt-2">
          <!-- Tabs Title -->
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Sell Product</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Buy
                Product</button>
            </li>
          </ul>
          <!-- Tabs Content -->
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
              tabindex="0">
              {{-- Untuk Penjual --}}
              @foreach ($sellTransactions as $sellTransaction)
              <div class="col-12 mt-2">
                <a href="{{route('dashboard-transactions-details', $sellTransaction->id)}}"
                  class="card card-list d-block mt-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{Storage::url($sellTransaction->product->galleries->first()->photos) ?? ''}}" alt=""
                          class="w-75">
                      </div>
                      {{-- <h1>{{$sellTransaction->products_id}}</h1> --}}
                      <div class="col-md-4">{{$sellTransaction->product->name}}</div>
                      <div class="col-md-3">{{$sellTransaction->product->user->store_name}}</div>
                      <div class="col-md-3">{{$sellTransaction->created_at}}</div>
                      <div class="col-md-1 d-none d-md-block">
                        <img src="/images/dashboard-arrow-right.svg" alt="">
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach
            </div>

            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

              {{-- Untuk Penjual --}}
              @foreach ($buyTransactions as $buyTransaction)
              <div class="col-12 mt-2">
                <a href="{{route('dashboard-transactions-details', $buyTransaction->id)}}"
                  class="card card-list d-block mt-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{Storage::url($buyTransaction->product->galleries->first()->photos) ?? ''}}" alt=""
                          class="w-75">
                      </div>
                      {{-- <h1>{{$buyTransaction->products_id}}</h1> --}}
                      <div class="col-md-4">{{$buyTransaction->product->name}}</div>
                      <div class="col-md-3">{{$buyTransaction->product->user->store_name}}</div>
                      <div class="col-md-3">{{$buyTransaction->created_at}}</div>
                      <div class="col-md-1 d-none d-md-block">
                        <img src="/images/dashboard-arrow-right.svg" alt="">
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection