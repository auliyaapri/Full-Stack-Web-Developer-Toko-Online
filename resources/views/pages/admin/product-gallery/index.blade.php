@extends('layouts.admin')

@section('title')
Product Gallery
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">product</h2>
            <p class="dashboard-subtitle">List of Gallery
            <p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('product-gallery.create')}}" class="btn btn-primary mb-3">+ Tambah Product Galerry</a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produk</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                    <tbody>
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
var datatable = $('#crudTable').DataTable({
    processing: true,
    serverSide: true,
    ordering: true,
    ajax: {
        url: '{!! url()->current() !!}',
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'product.name', name: 'product.name' },
        { data: 'photos', name: 'photos' },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable:false,
            width : '15%'
        }
    ]
});
</script>
@endpush