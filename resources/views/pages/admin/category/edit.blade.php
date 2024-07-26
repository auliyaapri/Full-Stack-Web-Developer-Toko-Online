@extends('layouts.admin')

@section('title')
Edit Category
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Edit Category</h2>
            <p class="dashboard-subtitle">Create New Category</p>
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
                            <form action="{{route('category.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama Kategori</label>
                                            <input type="text" name="name" value="{{$item->name}}" class="form-control" required>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Foto</label>                                            
                                            <input type="file" name="photo" value="{{$item->photo}}" class="form-control" required>
                                        </div>
                                    </div> --}}
                                    {{-- baru --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            @if($item->photo)
                                            <div>
                                                <div class="card" style="width: 10rem;">
                                                    <div class="card-body text-center">
                                                        <img src="{{ Storage::url ($item->photo) }}" alt="">
                                                    </div>
                                                  </div>
                                            </div>
                                            @else
                                            <div class="alert alert-warning" role="alert">
                                                Foto belum tersedia.
                                            </div>
                                            @endif
                                            <input type="file" name="photo" class="form-control mt-3">
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