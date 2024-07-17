@extends('layouts.admin')

@section('title')
Admin | Tranaction
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transaction</h2>
            <p class="dashboard-subtitle">List of Transactions
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
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($transactions as $tr)
                                        <tr>                                            
                                            <td>{{ $no++ }}</td>                                            
                                            {{-- <td>{{$tr->user->name}}</td> --}}
                                            <td>{{ $tr->user ? $tr->user->name : 'User tidak ditemukan' }}</td>

                                            <td>{{$tr->total_price}}</td>
                                            <td>{{$tr->transaction_status}}</td>
                                            {{-- <td>{{$tr->user->created_at}}</td> --}}
                                            <td>        
                                                <div class="btn-group">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                                            Aksi
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('transaction.edit', $tr->id) }}" class="dropdown-item">
                                                                Sunting
                                                            </a>
                                                            <form action="{{ route('transaction.destroy', $tr->id) }}" method="POST">
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
  function number_format(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>



@endpush