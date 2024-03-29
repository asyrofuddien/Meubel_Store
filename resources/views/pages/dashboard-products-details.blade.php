@extends('layouts.dashboard')

@section('title')
    Dashboard Detail Produk toko
@endsection

@section('content')
    <!-- Section Content -->
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Detail Produk</h2>
          <p class="dashboard-subtitle">Kelola Produk Anda.</p>
          <div class="dashboard-content">
            <div class="row">
              <div class="col-12">
                @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif
                <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input
                              type="text"
                              name="name"
                              class="form-control"
                              value="{{ $product->name }}"
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Harga</label>
                            <input
                              type="number"
                              name="price"
                              class="form-control"
                              value="{{ $product->price }}"
                              
                              oninput="calculateIncome(this.value)"
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Pendapatan</label>
                            <input
                              type="number"
                              name="price"
                              class="form-control"
                              id="incomeInput"
                              disabled
                              
                            />
                            <p class="text-secondary fs-6 font-italic"> <a class="text-danger">* </a>Pendapatan toko akan dikurangi 1%</p>
                          </div>
                        </div>
                        
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="categories_id" class="form-control">
                                <option value="{{ $product->category->id }}">Tidak diubah -> {{ $product->category->name }}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Deskripsi Produk</label>
                            <textarea
                              name="description"
                              id="editor"
                            > {!! $product->description !!}</textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col text-right">
                          <button
                            type="submit"
                            class="btn btn-success px-5 mt-4 btn-block"
                          >
                            Simpan
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      @foreach ($product->galleries as $gallery)
                        <div class="col-md-4">
                          <div class="gallery-container">
                            <img
                              src="{{ Storage::url($gallery->photos ?? '') }}"
                              alt=""
                              class="w-100 mb-4"
                            />
                            <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                              <img src="/images/icon-delete.svg" alt="" />
                            </a>
                          </div>
                        </div>
                      @endforeach
                      <div class="col-12 mt-3">
                        <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="products_id" value="{{ $product->id }}">
                          <input
                            type="file"
                            name="photos"
                            id="file"
                            style="display: none"
                            onchange="form.submit()"
                          />
                          <button
                            type="button"
                            class="btn btn-secondary btn-block"
                            onclick="thisFileUpload();"
                          >
                            Tambah Foto 
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
      </div>
    </div>
@endsection

@push('addon-script')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("editor");
  </script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
    function calculateIncome(value) {
    // Menghitung pendapatan dengan mengurangi 10% dari nilai yang dimasukkan
    let income = value - (value * 0.01);

    // Memperbarui nilai input pendapatan
    document.getElementById('incomeInput').value = income;
  }
  </script>
@endpush
