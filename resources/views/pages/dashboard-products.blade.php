@extends('layouts.dashboard')

@section('title')
Store Dashboard Product
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Prsssoduct</h2>
            <p class="dashboard-subtitle">Create your own product
            <p>
        </div>

        <div class="dashboard-content">
            <div class="row">
                <!-- Button -->
                <div class="col-12">
                    <a href="{{route('dashboard-products-create')}}" class="btn btn-success">Add New Products</a>
                </div>
            </div>
            <!-- Content Products -->
            <div class="row mt-4">
                <!-- Colomn Content Products -->
                @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{route('dashboard-products-details', $product->id)}}" class="card card-dashboard-product d-block">
                        <div class="card-body">
                            
                            
                            <img src="{{ Storage::url($product->galleries->first()->photos ?? '') }}" alt="sasassa" class="w-100 mb-2">

                            <div class="product-title">{{$product->name}}</div>
                            <div class="product-category">{{$product->category->name}}</div>
                        </div>
                    </a>
                </div>
                @endforeach
        
            </div>
        </div>
    </div>



</section>
@endsection