@extends('layouts.dashboard')

@section('title')
    @php 
        $user_name = $user->name;
        $first_name = explode(' ', trim($user_name))[0];
    @endphp

    {{$first_name}} | Account
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
                    <form action="{{route('dashboard-settings-redirect','dashboard-settings-account')}}" method="POST"
                        enctype="multipart/form-data" id="locations">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                                    <div class="col-md-6">
                                        <!-- Name and email -->
                                        <div class="form-group">
                                            <label for="addressOne">Nama Anda</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Email Anda</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{$user->email}}">

                                        </div>
                                    </div>
                                    <!-- Alamat -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Alamat</label>
                                            <input type="text" class="form-control" id="addressOne" name="address_one"
                                                value="{{$user->address_one}}">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressTwo">Alamat Tambahan</label>
                                            <input type="text" class="form-control" id="addressTwo" name="address_two"
                                                value="{{$user->address_two}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinces_id">Provinsi</label>
                                            @if ($user->provinces_id)

                                            <div class="form-control mb-3 bg-secondary-subtle">
                                                <div v-for="province in provinces" :key="province.id"
                                                    v-if="province.id === {{$user->provinces_id}}">
                                                    @{{ province.name }}
                                                </div>
                                            </div>
                                            @endif

                                            <select name="provinces_id" id="provinces_id" class="form-select"
                                                v-model="provinces_id" v-if="provinces">
                                                <option v-for="province in provinces" :value="province.id">
                                                    @{{province.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>                                            
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regencies_id">Kota</label>
                                            @if ($user->regencies_id)

                                            <div class="form-control mb-3 bg-secondary-subtle">
                                                {{ $regency->name }}
                                            </div>
                                            @endif
                                            <select name="regencies_id" id="regencies_id" class="form-select"
                                                v-model="regencies_id" v-if="regencies">
                                                <option v-for="regency in regencies" :value="regency.id">
                                                    @{{regency.name}}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postalCode">Kode Pos</label>
                                            <input type="text" class="form-control" id="postalCode" name="zip_code"
                                                value="{{$user->zip_code}}">
                                        </div>
                                    </div>
                                    <!-- County and Mobile -->                             
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phone_number">Nomor HP</label>
                                            <input type="text" class="form-control" id="phone_number"
                                                name="phone_number" value="{{$user->phone_number}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image_profile">Ganti Profile</label>
                                            <input type="file" class="form-control" id="image_profile"
                                                name="image_profile">
                                            <img src="{{ Storage::url($user->image_profile) != '/storage/' ? Storage::url($user->image_profile) : '/images/user_wtihout_image.png' }}"
                                                alt="Gambar Profil" class="img-fluid mt-4" style="max-width: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success w-25">Save Now</button>
                                    </div>
                                </div>
                    </form>

                    
                    @if ($user->image_profile != NULL)
                    <form action="{{ route('dashboard-settings-account.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Gambar </button>
                    </form>
                    @endif
                </div>
            </div>
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


{{-- ================== SWEET ALERT ======================== --}}

@if (Session::has('success_edit_account'))
<script>
    // Fungsi untuk menampilkan Sweet Alert saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success_edit_account') }}',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif

@if (Session::has('success_edit_account'))
<script>
    // Fungsi untuk menampilkan Sweet Alert saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success_edit_account') }}',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>
@endif
{{-- ================== SWEET ALERT ========================  --}}
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

{{-- php artisan make:migration add_quantity_to_products_table --table=products --}}

