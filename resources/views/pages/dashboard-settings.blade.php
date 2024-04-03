@extends('layouts.dashboard')

@section('title')
User | Settings
@endsection

@section('content')
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Store Settings</h2>
            <p class="dashboard-subtitle">Make store that profitable!</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('dashboard-settings-redirect','dashboard-settings-store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama Toko</label>
                                            <input type="text" class="form-control" name="store_name"
                                                value="{{$user->store_name}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label>Kategori : <span class="fw-bold"> {{ $categories->name }}
                                                </span></label> --}}
                                            @if($categories)
                                                <label>Kategori : <span class="fw-bold">{{ $categories->name}}</span></label>
                                            @else
                                                <label>Kategori : <span class="fw-bold">Tidak ada kategori</span></label>
                                            @endif

                                            <div id="transactionDetails">
                                                <select name="categories_id" class="form-control" v-model="categories">
                                                    <option value="{{ $user->categories_id }}">Tidak diganti</option>
                                                    @foreach ($category as $categor)
                                                    <option value="{{ $categor->id }}">{{ $categor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Store</label>
                                            <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                                            <div class="d-flex w-100">
                                                <!-- Jika True -->
                                                <div class="custom-control cutom-radio custom-control-inline p-0 m-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="store_status"
                                                            id="openStoreTrue" value="1" {{ $user->store_status == 1 ?
                                                        'checked' : '' }}>
                                                        <label class="form-check-label" for="openStoreTrue">
                                                            Buka
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Jika False -->
                                                <div class="custom-control cutom-radio custom-control-inline ps-3 m-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="store_status"
                                                            id="openStoreFalse" value="0" {{ $user->store_status == 0 ||
                                                        $user->store_status == NULL ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Sementara, Tutup
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
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
<script src="/vendor/vue/vue.js"></script>
<script>
    var transactionDetails = new Vue({
    el:'#transactionDetails',
    data: {
        categories: '{{ $user->categories_id }}',      
    }
  })
</script>


@endpush