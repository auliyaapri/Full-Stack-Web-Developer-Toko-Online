@extends('layouts.dashboard')
@section('title')
    @php 
        $user_name = $user->name;
        $first_name = explode(' ', trim($user_name))[0];
    @endphp
    {{$first_name}} | Details Product
@endsection

@section('content')
 <!-- section-content -->
 <section class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">        
        <h2 class="dashboard-title fw-bold">{{$products->name}}</h2>        
        <p class="dashboard-subtitle">Product <span class="text-muted">Details</span><p>
      </div>
      <div class="dashboard-content">

        <div class="row">
          <div class="col-12">
            <form action="{{ route('dashboard-products-update', $products->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
              <div class="card">
                <div class="card-body">
                  <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-md-6">
                      <!-- Product Name and Price -->
                      <div class="form-group">
                        <label>Product Name</label>
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          value="{{ $products->name }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="addressOne">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $products->price }}">                        
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="addressOne">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $products->quantity	 }}">                        
                      </div>
                    </div>

                    <!-- Category -->
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="province">Category</label>
                        <select class="form-control" aria-label="Default select example" name="categories_id"
                          id="categories_id">
                          <option value="{{ $products->categories_id }}">Tidak diganti ({{ $products->category->name }})</option>
                          @foreach ($categories as $categories)
                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                          @endforeach
                        </select>
                        {{-- baru --}}
                        
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="city">Description</label>
                        <div class="form-floating">                                
                            <textarea name="description" id="editor" rows="50" cols="80">
                              {{ $products->description }}
                            </textarea>                      
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-12 text-right">
                      <button type="submit" class="btn bt-block btn-success w-100">Save Now</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Image Thumbnails -->
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  @foreach ($products->galleries as $gallery)
                  <div class="col-md-4 mb-4">
                    <div class="gallery-container">
                      <img src="{{Storage::url($gallery->photos ?? '' )}}" alt="" class="w-100">                      
                        <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                        <img src="/images/icon-delete.svg" alt="">
                      </a>
                    </div>
                  </div>
                  @endforeach
                  <div class="col-12">
                    <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden"  value="{{ $products->id }}" name="products_id">

                      <input type="file" id="file" style="display: none" name="photos" onchange="form.submit()">
                      <button type="button" class="btn-upload btn btn-secondary btn-block mt-3" onclick="thisFileUpload()">
                      Add Photo
                    </button>

                  </form>
                  </div>
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


<!-- CKN EDITOR -->
  <script src="https://cdn.ckeditor.com/ckeditor5/35.0.0/classic/ckeditor.js"></script>
  <!-- Ketika klik Add Photo maka akan ada muncul upload gambar gitu padahalan button ya gaes ya -->
  <script>
      ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
      // <!-- END CKN EDITOR -->
      

      // Untuk Upload ya bre 
      function thisFileUpload() {
        document.getElementById("file").click();

        
      }

  
  </script>

@endpush