@extends('layouts.auth_baru')
@section('content')

<div class="d-lg-flex half">
  <div class="bg order-1 order-md-2"
    style="background-image: url('https://plus.unsplash.com/premium_photo-1709310749440-bfcae3e84c7e?q=80&w=2012&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
  </div>
  <div class="contents order-2 order-md-1" id="register">

    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-10">

          <h3>Register to <strong>dsds</strong></h3>
          <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
          <form method="POST" action="{{ route('register') }}" class="mt-3">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Full Name</label>
                  <input v-model="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              {{-- email --}}
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email Address</label>
                  <input v-model="email" @change="checkForEmailAvailability()" id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    :class="{ 'is-invalid': this.email_unavailable }" name="email" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              {{-- password --}}
              <div class="col-md-6">
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password_confirmation">Konfirmasi Password</label>
                  <input id="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required autocomplete="new-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              {{-- Buka Toko --}}
              <div class="col-md-12">
                <div class="form-group">
                  <label>Store</label>
                  <p class="text-muted">
                    Apakah anda juga ingin membuka toko?
                  </p>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue"
                      v-model="is_store_open" :value="true" />
                    <label for="openStoreTrue" class="custom-control-label">
                      Iya, boleh
                    </label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse"
                      v-model="is_store_open" :value="false" />
                    <label for="openStoreFalse" class="custom-control-label">
                      Enggak, makasih
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group" v-if="is_store_open">
                  <label>Nama Toko</label>
                  <input v-model="store_name" id="store_name" type="text"
                    class="form-control @error('store_name') is-invalid @enderror" name="store_name"
                    value="{{ old('store_name') }}" required autocomplete="store_name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group" v-if="is_store_open">
                  <label>Kategori</label>
                  <select name="category" class="form-control">
                    <option value="" disabled>Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>



            <div class="d-flex mb-5 align-items-center">
              <span class="ml-auto"><a href="{{route('register')}}" class="forgot-pass">Belum punya akun ?
                  Register</a></span>
            </div>
            <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">
              Sign Up Now
            </button>
            {{-- <button class="btn btn-block btn-primary"> Login </button> --}}
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection




@push('addon-script')
<script src="{{ asset('style/vendor/vue/vue.js') }}"></script>

<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    // Menggunakan plugin Vue Toasted
    Vue.use(Toasted);

    // Membuat instance Vue dengan nama "register"
    var register = new Vue({
        el: "#register", // Menentukan elemen HTML yang akan dimanipulasi oleh Vue
        data() {
            return {
                name: "Angga Hazza Sett",
                email: "kamujagoan@bwa.id",
                is_store_open: true,
                store_name: "",
                email_unavailable: false
            }
        },
        mounted() {
            AOS.init(); // Menginisialisasi library AOS untuk animasi
        },
        methods: {
            checkForEmailAvailability() {
                // Method untuk memeriksa ketersediaan email
                axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email
                        }
                    })
                .then(response => { // Menangani respons dari permintaan
                    // Menentukan pesan toast berdasarkan respons dari server
                    const message = response.data === 'Available' ? 'Email anda tersedia! Silahkan lanjut langkah selanjutnya!' : 'Maaf, tampaknya email sudah terdaftar pada sistem kami.';
                    
                    // Menentukan jenis toast berdasarkan respons dari server
                    const type = response.data === 'Available' ? 'success' : 'error';
                    
                    // Menampilkan pesan toast dengan menggunakan Vue Toasted
                    this.$toastedtype;
                    
                    // Mengubah nilai variabel email_unavailable berdasarkan respons dari server
                    this.email_unavailable = response.data !== 'Available';
                    
                    // Menampilkan data respons pada konsol browser
                    console.log(response.data);
                })
                .catch(error => { // Menangani kesalahan jika terjadi
                    console.error(error); // Menampilkan pesan kesalahan pada konsol browser
                });
            }
        },
    });
</script>

@endpush