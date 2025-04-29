@extends('master')
@section('breadcumb')
<p>Logistik / Detail barang masuk</p>
@endsection
@section('content')
<div class="row mx-0 my-3">
    <h1 class="text-center">
        Detail Barang Masuk
    </h1>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Detail Barang</h4>
            <form class="forms-sample" >
            <div class="form-group">
                <label for="kodebarang">Kode Barang</label>
                <input type="text" class="form-control" id="kodebarang"  value="{{$stok->kode_barang}}">
                </div>
              <div class="form-group">
                <label for="namabarang">Nama Barang</label>
                <input type="text" class="form-control" id="namabarang"  value="{{$stok->stok->nama_barang}}">
              </div>
              <div class="form-group">
                <label for="jumlahbarang">Jumlah / Quantity</label>
                <input type="text" class="form-control" id="jumlahbarang" value="{{$stok->jumlah}}">
              </div>
              <div class="form-group">
                <label for="asalbarang">Asal barang</label>
                <textarea class="form-control" id="asalbarang" rows="4" name="asalbarang">{{$stok->asal}}</textarea>
              </div>
              <div class="form-group">
                <label for="tanggalmasuk">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggalmasuk" value="{{$stok->tanggalmasuk}}">
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
