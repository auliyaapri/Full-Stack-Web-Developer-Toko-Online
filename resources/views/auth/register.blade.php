@extends('layouts.auth_baru')

@section('title')
Register
@endsection

@section('content')
<div class="page-content page-auth" id="register">
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('/images/surface-91HFUXYi_Jg-unsplash.jpg'); height: 110vh;"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-10 pt-4">
                        <h3>Register to <strong>WigunaStore</strong></h3>
                        <p class="mb-4 text-dark">Segera Registrasi untuk Mulai Menikmati Berbagai Penawaran Menarik di WigunaStore.</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkssap</label>
                                        <input v-model="name" id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input v-model="email" @change="getUserDataCheck()" id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            :class="{ 'is-invalid': this.email_unavailable }" name="email" required
                                            autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="form-group last mb-3">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" id="myInput"> 
                                            <input type="checkbox" onclick="myFunction()" class="mt-3"><span class="pl-2">Show Password</span>

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
                                            <input type="radio" class="custom-control-input" name="is_store_open"
                                                id="openStoreTrue" v-model="is_store_open" :value="true" />
                                            <label for="openStoreTrue" class="custom-control-label">
                                                Iya, boleh
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="is_store_open"
                                                id="openStoreFalse" v-model="is_store_open" :value="false" />
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
                                            class="form-control @error('store_name') is-invalid @enderror"
                                            name="store_name" value="{{ old('store_name') }}" required
                                            autocomplete="store_name" autofocus>
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
                                        <select name="categories_id" class="form-control">
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center"><span class="ml-auto"><a href="{{route('login')}}" class="forgot-pass">Sudah punya akun? Login</a></span> </div>
                            <button type="submit" class="btn btn-block btn-primary mt-4 mb-5":disabled="this.email_unavailable"> Sign Up Now</button>                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<SCript>
    function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</SCript>

@push('addon-script')

<script src="/vendor/vue/vue.js'"></script>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>

<script>
    // Menggunakan plugin Vue Toasted
    let coba = new Vue({
        el: "#register",
        mounted() {
            AOS.init();
        },
        data() {
            return {
                name: '',
                email: '',
                is_store_open: true,
                store_name: "",
                email_unavailable: false
            }
        },
        methods: {
            getUserDataCheck() {
                axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email
                        }
                        
                    })
                // axios.get('https://6d61-2400-9800-6036-341-f037-8046-f695-b237.ngrok-free.app/api-register-check', {
                //     params: {
                //         email: this.email
                //     }
                // })

                    .then(response => {
                        const message = response.data === 'Available' ? 'Email anda tersedia! Silahkan lanjut langkah selanjutnya!' : 'Maaf, tampaknya email sudah terdaftar pada sistem kami.';
                        // Menentukan jenis toast berdasarkan respons dari server
                        const type = response.data === 'Available' ? 'success' : 'error';
                        this.email_unavailable = response.data !== 'Available';
                        // Menampilkan data respons pada konsol browser
                        console.log(response.data);
                        // Menampilkan alert dengan data respons dengan penundaan
                        setTimeout(() => {
                            Swal.fire({
                                title: 'Informasi',
                                text: message,
                                icon: type, // Success atau Error
                                showConfirmButton: false, // Menghilangkan tombol OK
                                timer: 5000 // Menampilkan alert selama 5 detik
                            });
                        }, 0); // Menunda alert selama 2 detik sebelum ditampilkan
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
    })
</script>
@endpush