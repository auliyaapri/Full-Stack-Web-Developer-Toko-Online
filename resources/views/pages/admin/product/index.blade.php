@extends('layouts.admin')

@section('title')
Admin | Product
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">product</h2>
            <p class="dashboard-subtitle">List of products
            <p>
        </div>
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('product.create')}}" class="btn btn-primary mb-3">+ Tambah Product Baru</a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Pemilik / Useer</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp

                                        @foreach ($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->user->name}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>        
                                                <div class="btn-group">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                                            Aksi
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('product.edit', $product->id) }}" class="dropdown-item">
                                                                Sunting
                                                            </a>
                                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
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
    
    
    // Fungsi number_format untuk menambahkan titik sebagai pemisah ribuan
    // function number_format(number) {
    //     return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    // }
</script>
@endpush
