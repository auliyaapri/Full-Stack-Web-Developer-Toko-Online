@extends('layouts.dashboard')

@section('title')
@php
    $user_name = $user->name;
    $first_name = explode(' ', $user_name)[0];
@endphp

{{ $first_name }} | Product
@endsection


@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Product</h2>
            <p class="dashboard-subtitle">Create your own product
            <p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <!-- Button -->
                @if ($user->store_name == NULL|| $user->provinces_id == NULL)
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        Anda harus <strong> membuat store & melengkapi data diri </strong> terlebih terlebih dahulu sebelum menambahkan product!
                    </div>                    
                    <a href="{{route('dashboard-products-create')}}" class="btn btn-success disabled" role="button" aria-disabled="true">Add New Products</a>

                @else
                <div class="col-12">
                    <a href="{{route('dashboard-products-create')}}" class="btn btn-success">Add New Products</a>
                </div>
                    
                @endif
     
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
<!-- END STORE NEW PRODUCT -->
@if (Session::has('success'))
<script>
    // Fungsi untuk menampilkan Sweet Alert saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif

@if (Session::has('success_edit_products'))
<script>
    // Fungsi untuk menampilkan Sweet Alert saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success_edit_products') }}',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif
@endsection

