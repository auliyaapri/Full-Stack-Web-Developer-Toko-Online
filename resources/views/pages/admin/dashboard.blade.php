@extends('layouts.admin')

@section('title')
Store Dashboard
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Admin Dashboard</h2>
            <p class="dashboard-subtitle">This is BWASTORE Administrator
            <p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">Customer</div>
                            <div class="dashboard-card-subtitle">{{$customer}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">Revenue</div>
                            <div class="dashboard-card-subtitle">Rp. {{$revenue}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">Transaction</div>
                            <div class="dashboard-card-subtitle">{{$transaction}}</div>
                        </div>
                    </div>
                </div>
                <h5 class="mt-3">Recent Transactions</h5>
                {{-- 1 --}}
                <div class="col-12">
                    <div class="col-12 g-0 p-0">

                        <a href="/dashboard-transactions-details" class="card card-list d-block mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="/images/dashboard-icon-product-1.png" alt="">
                                    </div>
                                    <div class="col-md-4">Shirup MarzSSSan</div>
                                    <div class="col-md-3">Angga Risky</div>
                                    <div class="col-md-3">12 Januari, 2020</div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="/images/dashboard-arrow-right.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 g-0 p-0">
                        <a href="/dashboard-transactions-details" class="card card-list d-block mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="/images/dashboard-icon-product-1.png" alt="">
                                    </div>
                                    <div class="col-md-4">Shirup MarzSSSan</div>
                                    <div class="col-md-3">Angga Risky</div>
                                    <div class="col-md-3">12 Januari, 2020</div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="/images/dashboard-arrow-right.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                {{-- 2 --}}
                {{-- <div class="col-12 bg-danger">
                    <a href="/dashboard-transactions-details" class="card card-list d-block mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/images/dashboard-icon-product-1.png" alt="">
                                </div>
                                <div class="col-md-4">Shirup MarzSSSan</div>
                                <div class="col-md-3">Angga Risky</div>
                                <div class="col-md-3">12 Januari, 2020</div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img src="/images/dashboard-arrow-right.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>



</section>
@endsection