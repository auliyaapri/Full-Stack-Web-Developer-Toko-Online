@extends('layouts.app')

@section('title')
Products
@endsection

@section('content')
<div class="page-content page-home">  
    <section class="section-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Productss</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0; @endphp
      
                @forelse ($products as $product)
                    @foreach ($product->galleries as $gallery)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementCategory }}">
                        <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                            <div class="products-thumbnail">
                                <div class="products-image" style="background-image: url('{{ Storage::url($gallery->photos) }}');"></div>
                            </div>
                            <div class="products-text">{{ $product->name }}</div>
                            <div class="products-price">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>
                        </a>
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
