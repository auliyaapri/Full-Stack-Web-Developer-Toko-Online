@extends('layouts.admin')

@section('title')
User
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
            <p class="dashboard-subtitle">List of Customer Users
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
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nama Toko</th>
                                            <th>Roles</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                              
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($get_user as $user)
                                        <tr>
                                            <td>{{$user->no++}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->store_name}}</td>
                                            <td>{{$user->roles}}</td>
                                            <td>

                                                {{-- <a href="{{route('store.detail')}}" class=""> --}}
                                                    <i class="fa fa-eye btn btn-success"></i> <!-- Icon mata -->
                                                {{-- </a> --}}
                                                <i class="fa fa-pencil btn btn-primary"></i> <!-- Icon pensil -->
                                                <i class="fa fa-trash btn btn-danger"></i> <!-- Icon hapus -->
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

{{-- @push('addon-script')
<script>
    // Inisialisasi DataTable
    let datatable = $('#crudTable').DataTable({
        // Menandakan bahwa proses loading data sedang berlangsung
        processing: true,
        // Menggunakan server-side processing
        serverSide: true,
        // Mengaktifkan fitur pengurutan data
        ordering: true,
        // Mengatur URL endpoint untuk mengambil data
        ajax: {
            url: '{!! url()->current() !!}',
        },
        // Mendefinisikan kolom-kolom tabel
        columns: [
            // Kolom ID
            {data: 'id', name: 'id'},
            // Kolom Nama
            {data: 'name', name: 'name'},
            // Kolom email
            {data: 'email', name: 'email'},            
            // Kolom role
            {data: 'roles', name: 'roles'},
            // Kolom Aksi
            {
                // Data yang akan ditampilkan dalam kolom ini
                data: 'action',
                // Nama kolom
                name: 'action',
                // Mengatur apakah kolom dapat diurutkan
                orderable: false,
                // Mengatur apakah kolom dapat dicari
                searchable: false,
                // Mengatur lebar kolom
                width: '15%'
            },
        ]
    });
</script>
@endpush --}}