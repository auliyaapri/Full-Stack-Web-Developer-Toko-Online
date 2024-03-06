@extends('layouts.auth')

@section('title')
Store Home Page
@endsection

@section('content')

<div class="page-content page-auth" id="register">
    <section class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center justify-content-center row-login">
                <div class="col-lg-4">
                    <h2>Memulai untuk jual beli <br />dengan cara terbaru</h2>
                    <form method="POST" action="{{ route('register') }}" class="mt-3">
                        @csrf
                        <!-- Tambahkan CSRF token untuk keamanan -->
                        <div class="form-group">
                            <label>Full Name</label>
                            <input 
                                v-model="name"
                                id="name" 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autocomplete="name" 
                                autofocus
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label>Email Address</label>
                            <input v-model="email" @change="checkForEmailAvailability()" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                :class="{ 'is-invalid': this.email_unavailable }" name="email" required
                                autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Password --}}
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
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
                        {{-- Buka Toko --}}
                        <div class="form-group">
                            <label>Store</label>
                            <p class="text-muted">
                                Apakah anda juga ingin membuka toko?
                            </p>
                            <div
                            class="custom-control custom-radio custom-control-inline"
                            >
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    name="is_store_open"
                                    id="openStoreTrue"
                                    v-model="is_store_open"
                                    :value="true"
                                />
                                <label for="openStoreTrue" class="custom-control-label">
                                    Iya, boleh
                                </label>
                            </div>
                            <div
                                class="custom-control custom-radio custom-control-inline"
                            >
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    name="is_store_open"
                                    id="openStoreFalse"
                                    v-model="is_store_open"
                                    :value="false"
                                />
                                <label for="openStoreFalse" class="custom-control-label">
                                    Enggak, makasih
                                </label>
                            </div>
                        </div>

                        <div class="form-group" v-if="is_store_open">
                            <label>Nama Toko</label>
                            <input 
                                v-model="store_name"
                                id="store_name" 
                                type="text" 
                                class="form-control @error('store_name') is-invalid @enderror" 
                                name="store_name" 
                                value="{{ old('store_name') }}" 
                                required 
                                autocomplete="store_name" 
                                autofocus
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" v-if="is_store_open">
                            <label>Kategori</label>
                            <select name="category" class="form-control">
                                <option value="" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success btn-block mt-4"
                            :disabled="this.email_unavailable"
                        >
                            Sign Up Now
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                            Back to Sign In
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection


@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    // Menggunakan plugin Vue Toasted
Vue.use(Toasted);

// Membuat instance Vue dengan nama "register"
var register = new Vue({
    el: "#register", // Menentukan elemen HTML yang akan dimanipulasi oleh Vue
    mounted() {
        AOS.init(); // Menginisialisasi library AOS untuk animasi
    },
    methods: {
        checkForEmailAvailability() {
            // Method untuk memeriksa ketersediaan email
            axios.get('{{ route('api-register-check') }}', { // Melakukan permintaan GET ke endpoint 'api-register-check'
                params: { // Parameter yang dikirimkan dalam permintaan
                    email: this.email // Mengirimkan nilai email dari input form
                }
            })
            .then(response => { // Menangani respons dari permintaan
                // Menentukan pesan toast berdasarkan respons dari server
                const message = response.data === 'Available' ? 'Email anda tersedia! Silahkan lanjut langkah selanjutnya!' : 'Maaf, tampaknya email sudah terdaftar pada sistem kami.';
                
                // Menentukan jenis toast berdasarkan respons dari server
                const type = response.data === 'Available' ? 'success' : 'error';
                
                // Menampilkan pesan toast dengan menggunakan Vue Toasted
                this.$toasted[type](message, {
                    position: "top-center", // Menentukan posisi toast
                    className: "rounded", // Menentukan kelas CSS untuk styling toast
                    duration: 5000, // Menentukan durasi tampilan toast
                });
                
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

      data() {
          return {
              name: "Angga Hazza Sett",
              email: "kamujagoan@bwa.id",
              is_store_open: true,
              store_name: "",
              email_unavailable: false
          }
      },
    });
</script>
@endpush