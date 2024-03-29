@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Create
@endsection

@section('content')
    <!-- Section Content -->
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Tambah Produk</h2>
          <p class="dashboard-subtitle">Tambahkan Produk Anda</p>
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
                <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control" name="price" oninput="calculateIncome(this.value)" value="{{ old('price') }}" />
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Pendapatan</label>
                            <input type="number" class="form-control" name="harga" id="incomeInput" disabled/>
                            <p class="text-secondary fs-6 font-italic"> <a class="text-danger">* </a>Pendapatan toko akan dikurangi 1%</p>
                          </div>
                        </div>
                        
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="categories_id" class="form-control">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <textarea
                              name="description"
                              id="editor"
                              
                            >{{ old('description') }}</textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Thumbnails</label>
                            <input type="file" name="photo" class="form-control" />
                            <p class="text-muted">
                              Kamu dapat memilih lebih dari satu file
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col text-right">
                          <button
                            type="submit"
                            class="btn btn-success px-5 mt-4 btn-block"
                          >
                            Tambah Produk
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
@endpush
<script>
  function calculateIncome(value) {
    // Menghitung pendapatan dengan mengurangi 10% dari nilai yang dimasukkan
    let income = value - (value * 0.01);

    // Memperbarui nilai input pendapatan
    document.getElementById('incomeInput').value = income;
  }
</script>