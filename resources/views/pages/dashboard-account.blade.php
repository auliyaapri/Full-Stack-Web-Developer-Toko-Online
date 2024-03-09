@extends('layouts.dashboard')

@section('title')
Store Dashboard
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My Account</h2>
            <p class="dashboard-subtitle">Update your current profile</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('dashboard-settings-redirect','dashboard-settings-account')}}" method="POST" enctype="multipart/form-data" id="locations">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                                    <div class="col-md-6">
                                        <!-- Name and email -->
                                        <div class="form-group">
                                            <label for="addressOne">Your Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Your Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{$user->email}}">

                                        </div>
                                    </div>
                                    <!-- Alamat -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Address 1</label>
                                            <input type="text" class="form-control" id="addressOne" name="address_one"
                                                value="{{$user->address_one}}">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressTwo">Address 2</label>
                                            <input type="text" class="form-control" id="addressTwo" name="address_two"
                                                value="{{$user->address_two}}">
                                        </div>
                                    </div>
                                    <!-- Province, City, Postal Code -->
                                    <!-- Province -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinces_id">Province</label>
                                            
                                            <select name="provinces_id" id="provinces_id" class="form-select"
                                                v-model="provinces_id" v-if="provinces">                                                
                                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                            
                                        </div>
                                        <h1 v-for="province in provinces" :key="province.id" v-if="province.id === {{$user->provinces_id}}">
                                            @{{ province.name }}
                                        </h1>
                                        
                                        <h1>{{$user->provinces_id}}</h1>
                                    </div>
                                    <!-- City -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regencies_id">City</label>
                                            <select name="regencies_id" id="regencies_id" class="form-select"
                                                v-model="regencies_id" v-if="regencies">
                                                <option v-for="regency in regencies" :value="regency.id">@{{regency.name
                                                    }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postalCode">Postal Code</label>
                                            <input type="text" class="form-control" id="postalCode" name="zip_code" value="{{$user->zip_code}}">
                                        </div>
                                    </div>
                                    <!-- County and Mobile -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country" value="{{$user->country}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number">Mobile</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$user->phone_number}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image_profile">Ganti Profile</label>
                                            <input type="file" class="form-control" id="image_profile" name="image_profile">
                                            <img src="{{ Storage::url($user->image_profile) }}" alt="Gambar Profil" class="img-fluid mt-3" style="max-width: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success w-25">Save Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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