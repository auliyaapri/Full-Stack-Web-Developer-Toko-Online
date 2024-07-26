@extends('layouts.admin')

@section('title')
Admin | Edit Product
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Edit Product</h2>
            <p class="dashboard-subtitle">Edit this Product</p>
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
                            <form action="{{route('product.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama product</label>
                                            <input type="text" name="name" class="form-control" value="{{$item->name}}"  required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Pemilik Product</label>
                                            <select name="users_id" class="form-control">
                                                <option value="{{ $item->users_id }}">{{ $item->user->name }}</option>
                                                <option value="" disabled>----------------</option>
                                                @foreach ($users as $user)
                                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Kategori product</label>                                            
                                            <select class="form-select" aria-label="Default select example"
                                                name="categories_id">
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Harga product</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp. </span>
                                                <input type="number" name="price" class="form-control" value="{{$item->price}}" required>
                                              </div>                                            
                                        </div>
                                    </div>
                                  

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskripsi Produk</label>
                                            <textarea class="form-control" placeholder="Leave a comment here"
                                                id="editor" name="description">{{$item->description}}</textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush

