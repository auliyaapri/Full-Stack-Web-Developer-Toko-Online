@extends('layouts.app')

@section('title')
Products
@endsection

<br>
<br>
@section('content')
<div class="page-content page-home">
    <section class="section-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0; @endphp

                @forelse ($products as $product)
                @foreach ($product->galleries as $gallery)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $incrementCategory }}">
                    <div class="product-item">
                        <a href="{{ route('detail', $product->slug) }}">
                            <img src="{{ Storage::url($product->galleries->first()->photos) }}"
                                alt="{{ $product->name }}">
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
        </div>
    </section>
</div>
@endsection