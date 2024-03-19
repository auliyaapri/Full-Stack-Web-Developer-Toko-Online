@extends('layouts.admin')

@section('title')
Admin | Dashboard
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Admin Dashboard</h2>
            <p class="dashboard-subtitle">This is Wiguna Administrator<p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">Customer</div>
                            <div class="dashboard-card-subtitle">
                                <i style="color: #eb690a" class="fa fa-user"></i> 
                                <span class="ms-3">{{$customer}}</span>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">Revenue</div>
                            <div class="dashboard-card-subtitle">
                                <i style="color: #eb690a" class="fa fa-line-chart"></i> 
                                <span class="ms-3">                                
                                {{"Rp. ". number_format($revenue, 0, ',', '.')}}
                            </span>                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">Transaction</div>
                            <div class="dashboard-card-subtitle">
                                <i style="color: #eb690a" class="fa fa-exchange"></i> 
                                <span class="ms-3">{{$transaction}}</span>
                            
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>

     <!-- Untuk revenue -->
    <i class="fas fa-exchange-alt"></i> <!-- Untuk transaction -->
    

</section>
@endsection