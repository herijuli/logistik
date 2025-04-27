@extends('master')
@section('breadcumb')
<p>Logistik / Detail barang jenis baru</p>
@endsection
@section('content')
<div class="row mx-0 my-3">
    <h1 class="text-center">
        Detail Barang Jenis Baru
    </h1>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Detail Barang Jenis Baru</h4>
            <form class="forms-sample" action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kodebarang">Kode Barang</label>
                    <input type="text"  id="kodebarang" class="form-control" value="{{$stok->kode_barang}}">
                </div>
                <div class="form-group">
                    <label for="namabarang">Nama Barang</label>
                    <input type="text" id="kodebarang" class="form-control" value="{{$stok->nama_barang}}">
                </div>
              <div class="form-group">
                <label for="jumlahbarang">Jumlah / Quantity</label>
                <input type="text" class="form-control" id="jumlahbarang" placeholder="Masukkan Jumlah" value="{{$stok->jumlah}}">
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
