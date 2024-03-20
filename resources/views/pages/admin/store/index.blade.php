@extends('layouts.admin')

@section('title')
Admin | Store
@endsection

@push('addon-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Store Customer</h2>
            <p class="dashboard-subtitle">List of users
            <p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">                            
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nama Toko</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($get_user as $user)
                                        <tr>
                                            {{-- <td>{{$user->id}}</td> --}}
                                            <td>{{$no++}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->store_name}}</td>                                            
                                            <td>        
                                                <a href="{{ route('store-detail', $user->id) }}" class="">                                                    
                                                    <i class="fa fa-pencil btn btn-primary"></i> <!-- Icon pensil -->
                                                </a>
                                                <i class="fa fa-trash btn btn-danger" onclick="deleteItem()"></i> <!-- Icon hapus -->
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
    
<script>
    function deleteItem() {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus item ini?");
        if (confirmation) {
            // Proses penghapusan
            alert("Item telah dihapus.");
        } else {
            // Batal menghapus
            alert("Penghapusan dibatalkan.");
        }
    }
    </script>

    