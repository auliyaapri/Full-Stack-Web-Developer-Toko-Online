@extends('layouts.dashboard')

@section('title')
Store Dashboard Product
@endsection

@section('content')
<!-- section-content -->
<section class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">#{{$transaction->code}}</h2>
      <p class="dashboard-subtitle">Transaction / Details</p>

    </div>
    <div class="dashboard-content " id="transactionDetails">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-4">
                  <img src="{{Storage::url($transaction->product->galleries->first()->photos ?? '')}}"
                    class="w-100 mt-3" alt="">
                </div>
                <div class="col-12 col-md-8 mt-3">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Nama Pelanggan</div>
                      
                      <div class="product-subtitle">{{$transaction->transaction->user->name}} </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Nama Produk</div>                                          
                      <div class="product-subtitle">{{$transaction->product->name}} </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Tanggal Transaksi</div>
                      <div class="product-subtitle">{{$transaction->transaction->created_at}}</div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Status Pembayaran</div>
                      <div class="product-subtitle">
                        @if ($transaction->transaction->transaction_status == "PENDING")
                        <span class="text-danger fw-bold"> {{$transaction->transaction->transaction_status}} </span>
                    @else
                        <span class="text-success fw-bold"> {{$transaction->transaction->transaction_status}} </span>
                    @endif
                    
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Total Harga</div>
                      <div class="product-subtitle">Rp. {{ number_format($transaction->price, 0, ',', '.') }}</div>
                      {{$transaction->transaction->users_id}}
                      </h1>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Nomor Telepon</div>
                      <div class="product-subtitle">{{$transaction->transaction->user->phone_number}}</div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Jumlah Produk</div>
                      <div class="product-subtitle">{{$transaction->quantity}}</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== Jika yang punya toko =============== -->
              <div class="row">
                <div class="col-12 mt-4 mb-2">
                  <h5>Informasi Pengiriman</h5>                  
                </di>

                <!-- Address -->
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Alamat 1</div>
                      <div class="product-subtitle">{{$transaction->transaction->user->address_one}}</div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Alamat 2</div>
                      <div class="product-subtitle">{{$transaction->transaction->user->address_two}}</div>
                    </div>
                  </div>
                </div>

                <!-- Province City -->
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Provinsi</div>
                      <div class="product-subtitle">{{
                        App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}</div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Kota</div>
                      <div class="product-subtitle">{{
                        App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}</div>
                    </div>
                  </div>
                </div>

                <!-- Resi -->
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Kode POS</div>
                      <div class="product-subtitle">{{$transaction->transaction->user->zip_code}}</div>
                    </div>                    
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Status Pengiriman</div>                      
                      <div class="product-subtitle">{{$transaction->shipping_status}}</div>
                    </div>
                  </div>
                </div>

                <!-- Resi -->
                {{-- Jika CUSTOMER NAME SAMA DENGAN YANG SEKARANG LOGIN --}}
                @if ((Auth::user()->name != $transaction->transaction->user->name))
                <form action="{{route('dashboard-transactions-update', $transaction->id)}}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">Shipping Status</div>
                        <select name="shipping_status" id="status" class="form-select" v-model="status">
                          <option value="UNPAID">Unpaid</option>
                          <option value="PENDING">Pending</option>
                          <option value="SHIPPING">Shipping</option>
                          <option value="SUCCESS">Success</option>
                        </select>
                      </div>
                      <template v-if="status == 'SHIPPING'">
                        <div class="col-md-3">
                          <div class="product-title mb-2">Input Resi</div>
                          <input type="text" class="form-control" name="resi" v-model="resi" />
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success btn-block mt-4">Update Resi</button>
                        </div>
                      </template>
                    </div>
                  </div>
                  <!-- Resi -->
                  <div class="row mt-4">
                    <div class="col-12 mt-4 mb-2 text-right">
                      <button type="submit" class="btn btn-success mt-4 px-5 py-2">Save Now</button>
                    </div>
                  </div>
                </form>
                @endif
                <!-- End jika yang punya toko -->

                {{-- Jika CUSTOMER NAME BEDA DENGAN YANG SEKARANG LOGIN --}}
                @if ((Auth::user()->name == $transaction->transaction->user->name))
                  @if ($review && $review->rating !== null)
                  <form action="{{ route('dashboard-review-update', $transaction->transaction->id) }}" method="POST"
                    class="g-0" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                      <div class="row">
                        <div class="col-12 col-md-12">
                          <div class="product-title mb-2">Update Rating / Ulasan</div>
                          <select name="rating" id="status" class="form-select">
                            <option selected>Pilih Rating</option>
                            @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ $i==$review->rating ? 'selected' : ''
                              }}> {{ $i }} </option>
                              @endfor
                          </select>
                          <input type="text" class="form-control d-none mt-3" value="{{$transaction->product->id}}"
                            name="products_id">
                          <textarea name="comment" class="form-control mt-3" placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 100px">{{$review->comment}} </textarea>
                        </div>
                        <div class="col-12 text-right">
                          <button type="submit" class="btn btn-success mt-4 px-5 py-2">Save Now</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  @else
                  <form action="{{ route('dashboard-review-add', $transaction->transaction->id) }}" method="POST"
                    class="g-0" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                      <div class="row">
                        <div class="col-12 col-md-12">
                          <div class="product-title mb-2">Rating / Ulasan</div>
                          <select name="rating" id="status" class="form-select">
                            <option selected>Pilih Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                          <input type="text" class="form-control mt-3 d-none" name="products_id" value="{{$transaction->product->id}}">
                          <textarea name="comment" class="form-control mt-3" placeholder="Maskukan Ulasan Anda....." id="floatingTextarea2"
                            style="height: 100px"></textarea>
                        </div>
                        <div class="col-12 text-right">
                          <button type="submit" class="btn btn-success mt-4 px-5 py-2">Save Now</button>
                        </div>
                      </div>
                    </div>
                  </form>
                @endif              
              @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('addon-script')
<!-- Menu Button Mobile -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  $('#menu-toggle').on('click', function(e) {
    e.preventDefault();
    $('#wrapper').toggleClass('toggled');
  });
</script>

<script src="/vendor/vue/vue.js"></script>
<script>
  var transactionDetails = new Vue({
    el:'#transactionDetails',
    data: {
      status: '{{ $transaction->shipping_status }}',
      resi: '{{ $transaction->resi }}'
    }
  });
</script>

@if (Session::has('message'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      title: "Good job!",
      text: '{{ Session::get('message') }}',
      icon: "success"
    });
  });
</script>
@endif



@endpush