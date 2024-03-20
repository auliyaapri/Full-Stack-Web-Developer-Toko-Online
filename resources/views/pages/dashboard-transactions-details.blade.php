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
                      <div class="product-title mb-2">Customer Name</div>

                      <div class="product-subtitle">{{$transaction->transaction->user->name}} </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Nama Produk</div>
                      <div class="product-subtitle">{{$transaction->product->name}} </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Date of Transaction</div>
                      <div class="product-subtitle">{{$transaction->transaction->created_at}}</div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Payment Status</div>
                      <div class="product-subtitle text-danger">
                        {{$transaction->transaction->transaction_status}}
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Total Amount</div>
                      <div class="product-subtitle">Rp. {{ number_format($transaction->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title mb-2">Mobile</div>
                      <div class="product-subtitle">{{$transaction->transaction->user->phone_number}}</div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- Baris Baru -->
              {{-- <form action="{{route('dashboard-transactions-update', $transaction->id)}}" method="POST" enctype="multipart/form-data">
                @csrf --}}
                <div class="row">
                  <div class="col-12 mt-4 mb-2">
                    <h5>Shipping Information</h5>
                  </div>
                  <!-- Address -->
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">Address 1</div>
                        <div class="product-subtitle">{{$transaction->transaction->user->address_one}}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">Address 2</div>
                        <div class="product-subtitle">{{$transaction->transaction->user->address_two}}</div>
                      </div>
                    </div>
                  </div>
                  <!-- Province City -->
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">Province</div>
                        <div class="product-subtitle">
                          {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">City</div>
                        <div class="product-subtitle">
                          {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Resi -->
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">Postal Code</div>
                        <div class="product-subtitle">{{$transaction->transaction->user->zip_code}}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">Country</div>
                        <div class="product-subtitle">{{$transaction->transaction->user->country}}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title mb-2">shipping_status</div>
                        <div class="product-subtitle">{{$transaction->shipping_status}}</div>
                      </div>
                    </div>
                  </div>
                  <!-- Resi -->
                  {{-- <h1>as</h1> --}}





                  {{-- ===== INI JIKA CUSTOMER NAME SAMA DENGAN YANG SEKARANG LOGIN ===== --}}
                  @php
                  if (Auth::user()->name != $transaction->transaction->user->name) :
                  @endphp
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
                          <button type="submit" class="btn btn-success btn-block mt-4">
                            Update Resi
                          </button>
                        </div>
                      </template>
                    </div>
                  </div>


                  <!-- Resi -->


                </div>
                <div class="row mt-4">
                  <div class="col-12 mt-4 mb-2 text-right">
                    <button type="submit" class="btn btn-success mt-4 px-5 py-2">Save Now</button>
                  </div>
                </div>
                @php
                endif;
                @endphp
              {{-- </form> --}}

              {{-- ===== INI JIKA CUSTOMER NAME BEDA DENGAN YANG SEKARANG LOGIN ===== --}}
              @php
              if (Auth::user()->name == $transaction->transaction->user->name) :
              @endphp
              <form action="{{route('dashboard-transactions-add', $transaction->transaction->id)}}" method="POST">
                @csrf
                <h1>
                  {{$transaction->transaction->id}}
                </h1>
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 col-md-12">
                      <div class="product-title mb-2">Rating / Ulasan ASDSADASD</div>
                      <select name="rating" id="status" class="form-select">
                        <option selected>Pilih Rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                      <textarea name="comment" class="form-control mt-3" placeholder="Leave a comment here"
                        id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>

                    <div class="col-12 text-right">
                      <button type="submit" class="btn btn-success mt-4 px-5 py-2">Save Now</button>
                    </div>
                  </div>
                </div>
              </form>
              @php endif; @endphp
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
<script>
  $('#menu-toggle').on('click', function (e) {
    e.preventDefault(); // mencegah agar halaman tidak melakukan reload atau aksi default lainnya saat elemen #menu-toggle diklik.
    $('#wrapper').toggleClass('toggled')
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
  })
</script>


@endpush