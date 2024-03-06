@extends('layouts.auth')

@section('title')
Store Home Page
@endsection

@section('content')

<div class="page-content page-auth" id="register">
    <section class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-4">
            <h2>Memulai untuk jual beli <br />dengan cara terbaru</h2>
            <form action="" class="mt-3">
              <div class="form-group">
                <label for="">Full Name</label>
                <input type="text" class="form-control is-valid" v-model="name" autofocus />
              </div>
              <div class="form-group">
                <label for="">Email Address</label>
                <input type="email" class="form-control is-invalid" v-model="email" />
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="password" id="password" class="form-control" />
              </div>
              <div class="form-group">
                <label for="">Store</label>
                <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                <div class="d-flex w-100">
                  <!-- Jika True -->
                  <div class="custom-control cutom-radio custom-control-inline p-0 m-0">
                    <!-- <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue"
                      v-model="is_store_open" :value="true">
                    <label for="openStoreTrue" class="custom-control-label">Iya, boleh</label> -->                    
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Iya, boleh
                        </label>
                      </div>
                  </div>
                  <!-- Jika False -->
                  <div class="custom-control cutom-radio custom-control-inline ps-3 m-0">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Enggak, makasih
                      </label>
                    </div>

                  <!-- <div class="custom-control cutom-radio custom-control-inline" style="width: 100%;">
                    <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse"
                      v-model="is_store_open" :value="true">
                    <label for="openStoreFalse" class="custom-control-label">Enggak, makasih</label>
                  </div> -->
                  
                  

                </div>
              </div>
              </div>

              <div class="form-group" v-if="is_store_open">
                <label for="">Nama Toko</label>
                <input type="text" class="form-control" />
              </div>

              <div class="form-group" v-if="is_store_open">
                <label for="">Kategori</label>
                <select name="category" class="form-select" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                </select>
              </div>

              <a href="/dashboard.html" class="btn btn-success btn-block mt-4">
                Sign In to My Account
              </a>
              <a href="/login.html" class="btn btn-signup btn-block mt-4">
                Back to Sign In
              </a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>


@endsection


@push('addon-script')

@endpush