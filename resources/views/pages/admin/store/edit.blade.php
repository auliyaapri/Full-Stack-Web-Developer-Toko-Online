@extends('layouts.admin')

@section('title')
Edit User
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Edit User</h2>
            <p class="dashboard-subtitle">Please proceed to edit the user store listed below</p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('store-update-store', $user->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama user</label>
                                            <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                                required disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Email user</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{$user->email}}" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Toko</label>
                                            <input type="text" name="store_name" class="form-control"
                                                value="{{$user->store_name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Kategori</label>
                                            <div class="form-control mb-3 bg-secondary-subtle">
                                                {{ $user->category ? $user->category->name : '--- User belum mengisi kategori ---' }}
                                            </div>                                        
                                            <div id="selectCategories" class="mt-3">
                                                <select name="categories_id" class="form-select" v-model="categories">
                                                    <option selected value="">Pilih Kategori</option>
                                                    @foreach ($categoryTable as $categor)
                                                    <option value="{{ $categor->id }}">{{ $categor->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success btn-lg px-5">Save Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
{{-- <script>
    var selectCategories = new Vue({
    el:'#selectCategories',
    data: {
        categories: 'sdsdsd',      
        // categories: '{{ $user->categories_id }}',      
    }
  })
</script> --}}

<script>
    var selectCategories = new Vue({
        el:'#selectCategories',
        data: {
            categories: '',      
            // categories: '{{ $user->categories_id }}',      
        }
    })
    </script>
    