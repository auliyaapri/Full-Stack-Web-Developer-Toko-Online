@extends('layouts.admin')

@section('title')
Edit Transaction
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Edit Transaction</h2>
            <p class="dashboard-subtitle">
                Edit "{{$item->user->name}}" Transaaction
            </p>
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
                            <form action="{{route('transaction.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nama transaction</label>
                                            <input type="text" name="name" class="form-control" value="{{$item->user->name}}">
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Transaction Status</label>                                            
                                            <select class="form-select" aria-label="Default select example" name="transaction_status">
                                                
                                                <option value="{{$item->transaction_status}}">{{$item->transaction_status}}</option>
                                                <option value="" disabled>------------------------</option>
                                                <option value="PENDING">PENDING</option>
                                                <option value="SHIPPING">SHIPPING</option>
                                                <option value="SUCCESS">SUCCESS</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Total Harga</label>
                                            <input type="number" name="total_price" class="form-control" value="{{$item->total_price}}" required>
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

