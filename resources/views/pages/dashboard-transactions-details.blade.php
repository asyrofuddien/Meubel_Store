@extends('layouts.dashboard')

@section('title')
    Dashboard Detail Transaksi Toko
@endsection

@section('content')
  <!-- Section Content -->
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">#{{ $transaction->code }}</h2>
        <p class="dashboard-subtitle">Detail Transaksi</p>
        <div>
          <div class="dashboad-content" id="transactionDetails">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-md-4">
                        <img
                          src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                          class="w-100 mb-3"
                          alt=""
                        />
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Nama Pelanggan
                            </div>
                            <div class="product-subtitle">
                              {{ $transaction->transaction->user->name }}
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Nama Produk
                            </div>
                            <div class="product-subtitle">
                              {{ $transaction->product->name }}
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Tanggal Transaksi
                            </div>
                            <div class="product-subtitle">
                              {{ $transaction->created_at }}
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="product-title">Status Transaksi</div>
                            @if($transaction->transaction->transaction_status==='BERHASIL')
                            <div class="product-subtitle text-success">
                              {{ $transaction->transaction->transaction_status }}
                            </div>
                            @else
                            <div class="product-subtitle text-danger">
                              {{ $transaction->transaction->transaction_status }}
                            </div>
                            @endif
                            
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="product-title">
                              Total Pembayaran
                            </div>
                            <div class="product-subtitle">
                              Rp. {{ number_format($transaction->transaction->total_price) }}
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="product-title">No HP</div>
                            <div class="product-subtitle">
                              {{ $transaction->transaction->user->phone_number }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-12 mt-4">
                          <h5>Status Pengiriman</h5>
                        </div>
                        <div class="col-12">
                          <div class="row">
                            <div class="col-12 col-md-6">
                              <div class="product-title">Alamat 1</div>
                              <div class="product-subtitle">
                                {{ $transaction->transaction->user->address_one }}
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <div class="product-title">Alamat 2</div>
                              <div class="product-subtitle">
                                {{ $transaction->transaction->user->address_two }}
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <div class="product-title">Provinsi</div>
                              <div class="product-subtitle">
                                {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <div class="product-title">Kota</div>
                              <div class="product-subtitle">
                                {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <div class="product-title">Kode Pos</div>
                              <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                              <div class="product-title">Negara</div>
                              <div class="product-subtitle">
                                {{ $transaction->transaction->user->country }}
                              </div>
                            </div>
                            {{-- @dd($transaction->product->user->id) --}}
                            {{-- @dd(auth()->user()->id) --}}
                            @if(auth()->user()->id===$transaction->product->user->id )
                            <template v-if="status == 'DIKIRIM'|| status == 'TERKIRIM' ||  status == 'PENDING'||  status == 'DIPROSES'">
                            <div class="col-12 col-md-3">
                              <div class="product-title">Status Pengiriman</div>
                              <select
                                name="shipping_status"
                                id="status"
                                class="form-control"
                                v-model="status"
                              >
                              <option value="DIPROSES">DIPROSES</option>
                              <option value="DIKIRIM">DIKIRIM</option>
                              <option value="TERKIRIM">TERKIRIM</option>
                                
                              </select>
                            </div>
                            </template>
                            
                            <template v-if="status == 'BERHASIL'">
                              <div class="col-md-3">
                                <div class="product-title">
                                  Resi
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="resi"
                                  v-model="resi"
                                  disabled
                                />
                              </div>
                              <div class="col-md-3">
                                <button
                                disabled
                                  class="btn bg-success mt-4 text-light"
                                >
                                  PESANAN BERHASIL
                                </button>
                              </div>
                            </template>

                            <template v-if="status == 'DIKIRIM'|| status == 'TERKIRIM'">
                              <div class="col-md-3">
                                <div class="product-title">
                                  Input Resi
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="resi"
                                  v-model="resi"
                                />
                              </div>
                              <div class="col-md-2">
                                <button
                                  type="submit"
                                  class="btn btn-success btn-block mt-4"
                                >
                                  Update Resi
                                </button>
                              </div>
                            </template>
                          </div>
                        </div>
                        @else
                        @if($transaction->transaction->transaction_status==='TERKIRIM')
                        <div class="col-12 col-md-3">
                          <div class="product-title">Konfirmasi Pesanan</div>
                          <select
                            name="shipping_status"
                            id="status"
                            class="form-control"
                            v-model="status"
                            
                          >
                          <option value="BERHASIL">KONFIRMASI</option>   
                          </select>
                          </div>
                          @endif
                        
                        <template v-if="status == 'DIKIRIM' || status == 'TERKIRIM' ||status == 'BERHASIL' ">
                          <div class="col-md-3">
                            <div class="product-title">
                              Nomor Resi
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              name="resi"
                              v-model="resi"
                              disabled
                            />
                          </div>
                          
                        </template>
                      </div> 
                    </div>
                        @endif
                      </div>
                      @if(auth()->user()->id===$transaction->product->user->id)
                      <template v-if="status == 'DIKIRIM'|| status == 'TERKIRIM' ||  status == 'PENDING'||  status == 'DIPROSES'">
                      <div class="row mt-4">
                        <div class="col-12">
                          <button
                            type="submit"
                            class="btn btn-success btn-lg"
                          >
                            Simpan
                          </button>
                        </div>
                      </div>
                      </template>
                      @else
                      @if($transaction->transaction->transaction_status==='TERKIRIM')
                      <div class="row mt-2">
                        <div class="col-12">
                          <button
                            type="submit"
                            class="btn btn-success btn-lg"
                          >
                            Konfirmasi Pesanan
                          </button>
                        </div>
                      </div>
                      @endif
                      @endif
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
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script>
    var transactionDetails = new Vue({
      el: "#transactionDetails",
      data: {
        status: "{{ $transaction->shipping_status }}",
        resi: "{{ $transaction->resi }}",
      },
    });
  </script>
@endpush