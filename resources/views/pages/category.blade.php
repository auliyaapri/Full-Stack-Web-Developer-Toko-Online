@extends('layouts.app')

@section('title')
{{-- Mendapatkan URL saat ini --}}
<?php $url = url()->current(); ?>

{{-- Mendapatkan jalur dari URL --}}
<?php $path = parse_url($url, PHP_URL_PATH); ?>

{{-- Memecah jalur menjadi segmen --}}
<?php $segments = explode('/', $path); ?>

{{-- Mendapatkan segmen terakhir --}}
<?php $lastSegment = end($segments); ?>

{{-- Mengonversi segmen terakhir menjadi huruf besar (capital) --}}
<?php $capitalizedSegment = ucwords($lastSegment); ?>

{{-- Output hanya segmen terakhir yang telah dikapitalisasi --}}
{{ $capitalizedSegment }}
@endsection

@section('content')
<!-- PAGE CONTENT -->
<div class="page-content page-home">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
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
                @php
                $categorySlug = request()->segment(count(request()->segments()));
                @endphp
                <h5 class="mb-3">All Products {{ ucfirst($categorySlug) }} </h5>
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
                            <a href="{{ route('detail', $product->slug) }}">
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
        {{-- <div class="row">
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div> --}}

    </div>
</section>
<!-- END STORE NEW PRODUCT -->

@endsection