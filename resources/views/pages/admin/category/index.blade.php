@extends('layouts.admin')

@section('title')
Admin | Category
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Category</h2>
            <p class="dashboard-subtitle">List of Categories
            <p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('category.create')}}" class="btn btn-primary mb-3">+ Tambah Kategori
                                Baru</a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Foto</th>
                                            <th>Slug</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp

                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td><img src="{{Storage::url($category->photo)}}" alt="Category Photo" style="width: 50px;"> </td>
                                            <td>{{$category->slug}}</td>
                                            <td>        
                                                <div class="btn-group">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                                            Aksi
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('category.edit', $category->id) }}" class="dropdown-item">
                                                                Sunting
                                                            </a>
                                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
    // // Inisialisasi DataTable
    // let datatable = $('#crudTable').DataTable({
    //     // Menandakan bahwa proses loading data sedang berlangsung
    //     processing: true,
    //     // Menggunakan server-side processing
    //     serverSide: true,
    //     // Mengaktifkan fitur pengurutan data
    //     ordering: true,
    //     // Mengatur URL endpoint untuk mengambil data
    //     ajax: {
    //         url: '{!! url()->current() !!}',
    //     },
    //     // Mendefinisikan kolom-kolom tabel
    //     columns: [
    //         // Kolom ID
    //         {data: 'id', name: 'id'},
    //         // Kolom Nama
    //         {data: 'name', name: 'name'},
    //         // Kolom Foto
    //         {data: 'photo', name: 'photo'},
    //         // Kolom Slug
    //         {data: 'slug', name: 'slug'},
    //         // Kolom Aksi
    //         {
    //             // Data yang akan ditampilkan dalam kolom ini
    //             data: 'action',
    //             // Nama kolom
    //             name: 'action',
    //             // Mengatur apakah kolom dapat diurutkan
    //             orderable: false,
    //             // Mengatur apakah kolom dapat dicari
    //             searchable: false,
    //             // Mengatur lebar kolom
    //             width: '15%'
    //         },
    //     ]
    // });
</script>


@endpush