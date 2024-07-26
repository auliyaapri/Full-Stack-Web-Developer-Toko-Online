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
            <p class="dashboard-subtitle">Create New User</p>
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
                            <form action="{{route('user.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama User</label>
                                            <input type="text" name="name" value="{{$item->name}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" name="photo" value="{{$item->photos}}" class="form-control" required>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama user</label>
                                            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Email user</label>
                                            <input type="email" name="email" class="form-control" value="{{$item->email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Password user</label>
                                            <input type="password" name="password" class="form-control">
                                            <small>Kosongkan jika tidak ingin mengganti password</small>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Roles</label>
                                            <select class="form-control form-select-xl" aria-label="Small select example" name="roles">
                                                <option value="{{$item->roles}}" selected>Tidak diganti</option>                                                
                                                <option value="ADMIN">ADMIN</option>
                                                <option value="USER">USER</option>                                                
                                              </select>
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