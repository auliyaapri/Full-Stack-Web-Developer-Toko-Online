@extends('layouts.app')

@section('title')
Product Details
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
                <a href="{{ url('/') }}">Home</a>

              </li>
              <li class="breadcrumb-item active">Products Details</li>
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
            <h1 class="mt-3 mb-2">{{ $products->name }}</h1>
            <div class="d-flex justify-content-between">
              <div class="owner">By {{ $products->user->store_name }}</div>
              {{-- <div class="owner">Nama user nya : {{ $products->user->name }}</div> --}}
              <div class="owner">
                <div class="mb-3 bg-secondary-subtle" id="locations">
                  <div v-for="province in provinces" :key="province.id"
                    v-if="province.id === {{$products->user->provinces_id}}">
                    @{{ province.name }}

                  </div>
                </div>
              </div>

            </div>
            <div class="d-flex justify-content-between">
              <div class="price">Rp. {{ number_format($products->price, 0, ',', '.') }}</div>
              <div class="stok">Stok : {{ $products->quantity}}</div>
            </div>
          </div>
          <div class="col-lg-4" data-aos="zoom-in">
            @auth

            <form action="{{ route('detail-add', $products->id) }}" method="POST" enctype="multipart/form-data">
              @csrf

              @if ($products->user->store_status == 0 && $products->user->name !== $user->name)
              <button class="btn btn-danger text-white btn-block mb-3 disabled">Toko tutup sementara waktu</button>
              @endif

              @if ($products->quantity <= 0 ) <button class="btn btn-danger text-white btn-block mb-3 disabled">Mohon
                Maaf Barang Habis</button>
                @endif

                @if ($products->user->store_status == 1 && $products->user->name !== $user->name)
                {{-- USER ID --}}
                <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="users_id">
                {{-- product id --}}
                <input type="hidden" class="form-control" value="{{$products->id}}" name="products_id">

                @if ($products->quantity > 0 )
                <div class="d-flex">
                  <input type="number" class="form-control mb-3 w-25 me-2" id="quantity" name="quantity" required
                    min="1" max="{{ $products->quantity }}">

                    @if (Auth::check() && Auth::user()->roles == "Admin" )
                        <a class="btn btn-success text-white btn-block mb-3 w-100" id="submit-btn" href="{{{ route('product.edit', $products->id) }}}" >Detail Barang</a>
                    @endif
                    @if (Auth::check() && Auth::user()->roles == "USER" )
                        <button type="submit" class="btn btn-success text-white btn-block mb-3 w-100" id="submit-btn">Add to Cart</button>
                    @endif
                    @if (!Auth::check() )
                        <button type="submit" class="btn btn-success text-white btn-block mb-3 w-100" id="submit-btn">DSADSADSA to Cart</button>
                    @endif
                  

                </div>
                <div id="error-message" class="text-danger" style="display:none;">Stok hanya {{ $products->quantity }}
                </div>
                @endif

                @endif

                @if ($products->user->name == $user->name)
                <a href="{{ url('dashboard/products/'.$products->id) }}"
                  class="btn btn-warning text-white btn-block mb-3">View Detail</a>
                @endif
            </form>
            @else



            @if (!Auth::check() && $products->quantity < 1) <button
              class="btn btn-danger text-white btn-block mb-3 disabled">Mohon Maaf Barang Habis</button>
              @endif

              @if (!Auth::check() && $products->quantity > 1)
              <button class="btn btn-success text-white btn-block mb-3" onclick="showLoginAlert()">Add to Cart</button>
              @endif



              {{-- <button class="btn btn-success text-white btn-block mb-3" onclick="showLoginAlert()">Add to
                Cart</button> --}}
              <script>
                function showLoginAlert() {
                  Swal.fire({
                      title: "Oops!",
                      text: "Kamu harus login terlebih dahulu!.",
                      icon: "error",
                      timer: 1500, // Waktu dalam milidetik (2 detik)
                      showConfirmButton: false // Menyembunyikan tombol "OK"
                  }).then(() => {
                      window.location.href = "{{ route('login') }}";
                  });
              }
              </script>
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
        </div>
      </div>
    </div>
  </section>

  <section class="store-review">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8 mt-3 mb-3">
          <h5>Customer Review ({{$review_count}})</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-8">
          <ul class="list-unstyled">
            @foreach ($reviews as $item)
            <li class="media">
              <img src="{{url('/images/icon-testimonial-1.png')}}" alt="" class="me-3 rounded-circle">
              <div class="media-body">
                <h5 class="mt-2 mb-1">{{$item->user->name}}</h5>
                <p>
                  @php $get_rating = $item->rating @endphp
                  @for ($i = 1; $i <= $get_rating; $i++) <i class="fa fa-star" style="color:gold;"></i>
                    @endfor
                </p>
                {{$item->comment}}
              </div>
            </li>

            @endforeach
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
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const quantityInput = document.getElementById('quantity');
      const submitButton = document.getElementById('submit-btn');
      const errorMessage = document.getElementById('error-message');
      const maxQuantity = {{ $products->quantity }};
      
      quantityInput.addEventListener('input', function () {
          const quantityValue = parseInt(quantityInput.value);
          if (quantityValue > maxQuantity) {
              errorMessage.style.display = 'block';
              submitButton.disabled = true;
          } else {
              errorMessage.style.display = 'none';
              submitButton.disabled = false;
          }
      });
  });
</script>

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

<script>
  var locations = new Vue({
      el: "#locations",
      mounted() {
          AOS.init();
          this.getProvincesData();
          this.getRegenciesData(); // tambahkan ini

      },
      data: {
          // Properti ini digunakan untuk menyimpan data provinsi, regencies, provinces_id, regencies_id yang akan diambil dari API
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null
      },
      methods: {
          getProvincesData() {
              axios.get('/api/provinces')
                  .then(response => {
                      this.provinces = response.data;
                      console.log(response.data);
                  })
                  .catch(error => {
                      console.error('Terjadi kesalahan:', error);
                  });
          },
          getRegenciesData() {
              axios.get('/api/regencies/' + this.provinces_id)
                  .then(response => {
                      this.regencies = response.data;
                  })
                  .catch(error => {
                      console.error('Terjadi kesalahan:', error);
                  });
          }
      },
      watch: {
          provinces_id: function(val, oldVal) {
              this.regencies_id = null;
              this.getRegenciesData();
          }
      }
  });
</script>
@endpush