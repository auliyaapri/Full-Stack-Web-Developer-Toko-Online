@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<!-- PAGE CONTENT -->
<div class="page-content page-home">
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div class="carousel slide" id="storeCarousel" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#storeCarousel" data-bs-slide-to="0" class="active" aria-current="true">
                            </li>
                            <li data-bs-target="#storeCarousel" data-bs-slide-to="1"></li>
                            <li data-bs-target="#storeCarousel" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/banner.jpg" class="d-block w-100" alt="Carousel Image">
                            </div>
                            <div class="carousel-item">
                                <img src="/images/banner2.png" class="d-block w-100" alt="Carousel Image">
                            </div>
                            <div class="carousel-item">
                                <img src="/images/banner3.png" class="d-block w-100" alt="Carousel Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Trend Categories</h5>
                </div>
            </div>

            {{-- ===== CATEGORIES ===== --}}
            <div class="row">
                @php $incrementCategory = 0; @endphp
                @forelse ($categories as $category)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory }}">
                    <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                        <div class="categories-image">
                            <img src="{{Storage::url($category->photo)}}" class="w-100" alt="">
                        </div>
                        <p class="categories-text">{{ $category->name }}</p>
                    </a>
                </div>
                @php $incrementCategory += 100; @endphp
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Categories Found
                </div>
                @endforelse
            </div>

            {{-- ===== END CATEGORIES ===== --}}

        </div>
    </section>
</div>
<!-- END PAGE CONTENT -->



<!-- STORE NEW PRODUCT -->
<section class="section-new-products">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up">
                <h5>New Products</h5>
            </div>
        </div>
        <div class="row">

            @php $incrementCategory = 0; @endphp

            @forelse ($products as $product)
            {{-- Loop melalui setiap produk --}}
            @foreach ($product->galleries as $gallery) {{-- galleries dapet dari model product relasi kaka --}}

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $incrementCategory }}">
                <div class="product-item">
                    <a href="{{ route('detail', $product->slug) }}">
                        <img src="{{ Storage::url($product->galleries->first()->photos) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="down-content">
                        <div class="d-flex align-items-start justify-content-start flex-column card-product">
                            <a href="{{ route('detail', $product->slug) }}" >
                                <h4>{{ $product->name }} </h4>
                            </a>
                            <h6>Rp. {{ number_format($product->price, 0, ',', '.') }}</h6>
                        </div>
                        <p class="mt-3">{{ Str::limit(strip_tags($product->description), 150, '...') }}</p>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span>Reviews (24)</span>
                    </div>
                </div>
            </div>



            @php $incrementCategory += 100; @endphp
            @break
            @endforeach

            @empty
            @endforelse
        </div>

    </div>
</section>
<!-- END STORE NEW PRODUCT -->
@if (Session::has('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            }).then(function() {
                @php
                    Session::forget('success');
                @endphp
            });
        });
</script>
@endif


@endsection