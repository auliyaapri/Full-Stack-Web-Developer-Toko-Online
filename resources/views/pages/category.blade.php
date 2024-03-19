@extends('layouts.app')

@section('title')
Categories
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
        
        <h5>All Products {{ ucfirst($categorySlug) }} </h5>
        



          </div>
      </div>
      <div class="row">
          @php $incrementCategory = 0; @endphp

          @forelse ($products as $product)
              {{-- Loop melalui setiap produk --}}
              @foreach ($product->galleries as $gallery) {{-- galleries dapet dari model product relasi kaka --}}                    
              <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementCategory }}">
                      
                        <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                          <div class="products-thumbnail">
                              <div class="products-image" style="background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');"></div>
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
      {{-- <div class="row">
        <div class="pagination">
            {{ $products->links() }}
        </div>
      </div> --}}
      
  </div>
</section>
<!-- END STORE NEW PRODUCT -->
    
@endsection
