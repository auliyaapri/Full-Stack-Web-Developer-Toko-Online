@extends('layouts.app')

@section('title')
Store Category Page
@endsection

@section('content')

<!-- PAGE CONTENT -->
<div class="page-content page-details">
  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="">Home</a>
              </li>
              <li class="breadcrumb-item active">Productss Details</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="store-gallery" id="gallery">
    <div class="container">
      <div class="row">
        <div class="col-lg-8" data-aos="zoom-in">
          <transition name="slide-fade" mode="out-in">
            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image" alt="" />
          </transition>
        </div>
        <div class="col-lg-2">
          <div class="row">
            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo_bre, index) in photos" :key="photo_bre.id"
              data-aos="zoom-in" data-aos-delay="100">

              <!-- Agar ketika di klik gambar berubah -->
              <a href="#" @click="changeActive(index)">
                <img :src="photo_bre.url" alt="" class="w-100 thumbnail-image"
                  :class="{active: index == activePhoto}" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="store-details-container" data-aos="fade-up">
    <section class="store-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h1 class="mt-3">{{ $products->name }}</h1>
            <div class="owner">By {{ $products->user->store_name }}</div>
            <div class="owner">By {{ $products->user->name }}</div>
            <div class="price">Rp. {{ number_format($products->price, 0, ',', '.') }}</div>
          </div>
          <div class="col-lg-2" data-aos="zoom-in">
            @auth           
              
              <form action="{{ route('detail-add', $products->id) }}" method="POST" enctype="multipart/form-data">              
                @csrf
                <button type="submit" class="btn btn-success text-white btn-block mb-3">Add to Cart</button>
              </form> 
            @else
              <a href="{{route('login')}}" class="btn btn-success text-white btn-block mb-3">Add to Cart</a>        
            @endauth
          </div>

        </div>
      </div>
    </section>

  </div>


  <section class="store-description">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8">
          <p>{!! $products->description !!}</p>
          <p>lorem</p>
        </div>
      </div>
    </div>
  </section>

  <section class="store-review">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8 mt-3 mb-3">
          <h5>Customer Review (3)</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-8">
          <ul class="list-unstyled">
            <li class="media">
              <img src="{{url('/images/icon-testimonial-1.png')}}" alt="" class="me-3 rounded-circle">
              <div class="media-body">
                <h5 class="mt-2 mb-1">Hazza Rizky</h5>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus at porro totam, repudiandae voluptas
                quibusdam eum dolorem debitis explicabo magnam sint ullam nisi iste! Voluptatum, iste! Laudantium, nam?
                Quaerat vel praesentium facere maxime, impedit sunt saepe quod deleniti harum, voluptates officiis earum
                ipsam, quae reiciendis dolor. Voluptatem doloremque dignissimos quis.
              </div>
            </li>
            <li class="media">
              <img src="{{url('/images/icon-testimonial-1.png')}}" alt="" class="me-3 rounded-circle">
              <div class="media-body">
                <h5 class="mt-2 mb-1">Hazza Rizky</h5>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus at porro totam, repudiandae voluptas
                quibusdam eum dolorem debitis explicabo magnam sint ullam nisi iste! Voluptatum, iste! Laudantium, nam?
                Quaerat vel praesentium facere maxime, impedit sunt saepe quod deleniti harum, voluptates officiis earum
                ipsam, quae reiciendis dolor. Voluptatem doloremque dignissimos quis.
              </div>
            </li>
            <li class="media">
              <img src="{{url('/images/icon-testimonial-1.png')}}" alt="" class="me-3 rounded-circle">
              <div class="media-body">
                <h5 class="mt-2 mb-1">Hazza Rizky</h5>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus at porro totam, repudiandae voluptas
                quibusdam eum dolorem debitis explicabo magnam sint ullam nisi iste! Voluptatum, iste! Laudantium, nam?
                Quaerat vel praesentium facere maxime, impedit sunt saepe quod deleniti harum, voluptates officiis earum
                ipsam, quae reiciendis dolor. Voluptatem doloremque dignissimos quis.
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

</div>
<!-- END PAGE CONTENT -->
@endsection

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/vendor/vue/vue.js"></script>

<script>
  var gallery = new Vue({
      el: "#gallery",
      mounted() {
        AOS.init({
          once: true,
        });
      },
      data: {
        activePhoto: 0,
        photos: [
            @foreach ($products->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
            @endforeach
          ],
        },
      methods: {
        changeActive(id) {
          this.activePhoto = id;
        },
      },
    });
</script>
@endpush