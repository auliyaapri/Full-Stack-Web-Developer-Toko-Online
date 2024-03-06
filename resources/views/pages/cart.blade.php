@extends('layouts.app')

@section('title')
Store Cart Page
@endsection

@section('content')
<!-- PAGE CONTENT -->
<div class="page-content page-cart">
  <!-- Breadcrumbs -->
  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="">Home</a>
              </li>
              <li class="breadcrumb-item active">Cart</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <!-- Cart Content -->
  <section class="store-cart">
    <div class="container">
      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-12 table-responsive">
          <!-- Cart Table -->
          <table class="table table-borderless table-cart">
            <thead>
              <tr>
                <td>Image</td>
                <td>Name &amp; Seller</td>
                <td>Price</td>
                <td>Menu</td>
              </tr>
            </thead>
            <tbody>
              @php $totalPrice = 0 @endphp
              @foreach ($carts as $cart)
              <tr>
                <!-- Product Image -->
                <td style="width: 20%;">
                  @if($cart->product->galleries)
                  <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt="" class="cart-image" />
                  @endif
                </td>
                <!-- Product Name & Seller -->
                <td style="width: 35%;">
                  <div class="product-title">{{ $cart->product->name }}</div>
                  <div class="product-subtitle">by {{ $cart->product->user->store_name }}</div>
                </td>
                <!-- Product Price -->
                <td style="width: 35%;">
                  <div class="product-title">Rp. {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                </td>
                <!-- Remove Button -->
                <td style="width: 20%;">
                  <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-remove-cart" type="submit">
                      Remove
                    </button>
                  </form>
                </td>
              </tr>
              @php $totalPrice += $cart->product->price @endphp
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Shipping Details -->
      <div class="row" data-aos="fade-up" data-aos-delay="150">
        <div class="col-12">
          <hr style="border-width: 4px;">
        </div>
        <div class="col-12">
          <h2 class="mb-4">Shipping Details</h2>
        </div>
      </div>

      <!-- Shipping Form -->
      <form action="{{route('checkout')}}" id="locations" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="total_price" value="{{$totalPrice}}">
        <!-- Address Fields -->
        <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
          <!-- Address 1 -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="address_one">Address 1</label>
              <input type="text" class="form-control" id="address_one" name="address_one">
            </div>
          </div>
          <!-- Address 2 -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="address_two">Address 2</label>
              <input type="text" class="form-control" id="address_two" name="address_two">
            </div>
          </div>
          <!-- Province -->
          <div class="col-md-4">
            <div class="form-group">
              <label for="provinces_id">Province</label>
              <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                <option selected>Open this select menu</option>
                <option v-for="province in provinces" :value="province.id">@{{ province.name}}</option>
              </select>
              <select v-else class="form-control"></select>
            </div>
          </div>
          <!-- City -->
          <div class="col-md-4">
            <div class="form-group">
              <label for="regencies_id">City</label>
              <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
              </select>
              <select v-else class="form-control"></select>
            </div>
          </div>
          <!-- Postal Code -->
          <div class="col-md-4">
            <div class="form-group">
              <label for="zip_code">Postal Code</label>
              <input type="text" class="form-control" id="zip_code" name="zip_code">
            </div>
          </div>
          <!-- Country -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="country">Country</label>
              <input type="text" class="form-control" id="country" name="country">
            </div>
          </div>
          <!-- Phone Number -->
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone_number">Phone Number</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
          </div>
        </div>

        <!-- Payment Details -->
        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-12">
            <hr style="border-width: 4px;">
          </div>
          <div class="col-12">
            <h2 class="mb-2">Payment Informations</h2>
          </div>
        </div>

        <!-- Price and Checkout Button -->
        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <!-- Taxes and Fees -->
          <div class="col-4 col-md-2">
            <div class="product-title">$10</div>
            <div class="product-subtitle">Country Tax</div>
          </div>
          <div class="col-4 col-md-3">
            <div class="product-title">$280</div>
            <div class="product-subtitle">Product Insurance</div>
          </div>
          <div class="col-4 col-md-2">
            <div class="product-title">$280</div>
            <div class="product-subtitle">Product Insurance</div>
          </div>
          <!-- Total Price -->
          <div class="col-4 col-md-2">
            <div class="product-title text-success">
              @php
              echo "Rp. ". number_format($totalPrice, 0, ',', '.'); // tampilkan total jumlah
              @endphp
            </div>
            <div class="product-subtitle">Total Belanja</div>
          </div>
          <!-- Checkout Button -->
          <div class="col-8 col-md-3">
            <button type="submit" class="btn btn-success mt-4 px-4 btn-block">Checkout Now</button>
          </div>
        </div>
      </form>
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
  var locations = new Vue({
      // Menghubungkan dengan elemen HTML dengan ID 'locations'
      el: "#locations",
      // Metode yang dijalankan setelah Vue instance di-mount pada elemen HTML
      mounted() {
          // Menginisialisasi library AOS (Animate On Scroll)
          AOS.init();
          // Memanggil metode untuk mendapatkan data provinsi saat komponen dimuat
          this.getProvincesData();
      },
      // Data yang digunakan pada komponen Vue
      data: {
          // Data provinsi yang akan diambil dari API
          provinces: null,
          // Data kota/kabupaten yang akan diambil dari API
          regencies: null,
          // ID provinsi yang dipilih
          provinces_id: null,
          // ID kota/kabupaten yang dipilih
          regencies_id: null
      },
      // Metode-metode yang digunakan dalam komponen Vue
      methods: {
          // Metode untuk mendapatkan data provinsi dari API
          getProvincesData() {
              // Menyimpan referensi 'this' ke dalam variabel 'self' untuk digunakan di dalam fungsi callback
              var self = this;
              // Melakukan permintaan GET ke endpoint API untuk mendapatkan data provinsi
              axios.get('{{ route('api-provinces') }}')
                  .then(function(response) {
                      // Menyimpan data provinsi yang diterima dari respons API ke dalam variabel 'provinces'
                      self.provinces = response.data;
                      // Menampilkan data provinsi pada konsol untuk keperluan debugging
                      console.log(response.data);
                  })
                  .catch(function(error) {
                      // Menampilkan pesan kesalahan jika permintaan gagal
                      console.error('Terjadi kesalahan:', error);
                  });
          },
          // Metode untuk mendapatkan data kota/kabupaten berdasarkan ID provinsi yang dipilih
          getRegenciesData() {
              // Menyimpan referensi 'this' ke dalam variabel 'self' untuk digunakan di dalam fungsi callback
              var self = this;
              // Melakukan permintaan GET ke endpoint API untuk mendapatkan data kota/kabupaten berdasarkan ID provinsi
              axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                  .then(function(response) {
                      // Menyimpan data kota/kabupaten yang diterima dari respons API ke dalam variabel 'regencies'
                      self.regencies = response.data;
                  })
                  .catch(function(error) {
                      // Menampilkan pesan kesalahan jika permintaan gagal
                      console.error('Terjadi kesalahan:', error);
                  });
          }
      },
      // Watcher untuk memantau perubahan pada ID provinsi yang dipilih
      watch: {
          provinces_id: function (val, oldVal) {
              // Mereset ID kota/kabupaten yang dipilih menjadi null saat ID provinsi berubah
              this.regencies_id = null;
              // Memanggil metode untuk mendapatkan data kota/kabupaten berdasarkan ID provinsi yang baru dipilih
              this.getRegenciesData();
          }
      }
  });
</script>

@endpush


