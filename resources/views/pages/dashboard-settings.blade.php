@extends('layouts.dashboard')

@section('title')
    Pengaturan Toko
@endsection

@section('content')
    <!-- Section Content -->
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
        <div class="container-fluid">
            <div class="dashboard-heading">
            <h2 class="dashboard-title">Pengaturan Toko</h2>
            <p class="dashboard-subtitle">Look what you have made today!</p>
            <div class="dashboard-content">
                <div class="row">
                <div class="col-12">
                    <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Toko</label>
                                    <input type="text" class="form-control" name="store_name" value="{{ $user->store_name }}" />
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="categories_id" class="form-control">
                                        <option value="{{ $user->categories_id }}">Tidak diubah</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status Toko</label>
                                    <p class="text-muted">
                                    Apakah anda ingin membuka toko?
                                    </p>
                                    <div
                                    class="custom-control custom-radio custom-control-inline"
                                    >
                                    <input
                                        type="radio"
                                        class="custom-control-input"
                                        name="store_status"
                                        id="openStoreTrue"
                                        value="1"
                                        {{ $user->store_status == 1 ? 'checked' : ''}}
                                    />
                                    <label
                                        for="openStoreTrue"
                                        class="custom-control-label"
                                    >
                                        <p>Buka</p></label
                                    >
                                    </div>
                                    <div
                                    class="custom-control custom-radio custom-control-inline"
                                    >
                                    <input
                                        type="radio"
                                        class="custom-control-input"
                                        name="store_status"
                                        id="openStoreFalse"
                                        value="0"
                                        {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : ''}}
                                    />
                                    <label
                                        for="openStoreFalse"
                                        class="custom-control-label"
                                        >Sementara Tutup</label
                                    >
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                <button
                                    type="submit"
                                    class="btn btn-success px-5 mt-4"
                                >
                                    Save Now
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