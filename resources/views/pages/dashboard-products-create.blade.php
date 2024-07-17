@extends('layouts.dashboard')
@section('title')
@php
$user_name = $user->name;
$first_name = explode(' ', trim($user_name))[0];
@endphp
{{$first_name}} | New Product
@endsection


@section('content')
<!-- section-content -->


<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Create New Product</h2>
            <p class="dashboard-subtitle">Create your own product
            <p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('dashboard-products-store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="users_id" id="" value="{{Auth::user()->id}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                                    <div class="col-md-6">
                                        <!-- Name and email -->
                                        <div class="form-group">
                                            <label for="addressOne">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" required>
                                        </div>
                                    </div>
                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="province">Category</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="categories_id">
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" name="quantity">
                                        </div>
                                    </div>
                                    <!-- DESCRIPTION -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="city">Description</label>
                                            <div class="form-floating">
                                                <textarea name="description" id="editor" rows="10" cols="80"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- UPLOAD GAMBAR --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="imageUpload" class="form-label">Choose Image</label>
                                                <input type="file" class="form-control" id="imageUpload" name="photo"
                                                    accept="image/*" required>

                                            </div>
                                        </div>
                                        @error('photo')
                                        <div class="text-danger fw-bold">{{ $message }}</div>
                                    @enderror
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success w-100">Create Product</button>
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

<!-- CKN EDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>
<!-- Ketika klik Add Photo maka akan ada muncul upload gambar gitu padahalan button ya gaes ya -->
<script>
    ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
</script>
<!-- END CKN EDITOR -->

@endpush