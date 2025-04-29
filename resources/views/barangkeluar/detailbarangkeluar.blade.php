@extends('master')
@section('breadcumb')
<p>Logistik / Detail barang keluar</p>
@endsection
@section('content')
<div class="row mx-0 my-3">
    <h1 class="text-center">
        Detail Barang Keluar
    </h1>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Detail Barang</h4>
            <form class="forms-sample" method="POST" action="">
                @method('PUT') @csrf
                <div class="form-group">
                <label for="kodebarang">Kode Barang</label>
                <input type="text" class="form-control" id="kodebarang"  value="{{$barangkeluar->kode_barang}}">
                </div>
                <div class="form-group">
                    <label for="namabarang">Nama Barang</label>
                    <input type="text" class="form-control" id="namabarang"  value="{{$barangkeluar->stok->nama_barang}}">
                </div>
              <div class="form-group">
                <label for="jumlahbarang">Jumlah / Quantity</label>
                <input type="text" class="form-control" id="jumlahbarang" value="{{$barangkeluar->jumlah}}">
              </div>
              <div class="form-group">
                <label for="asalbarang">Tujuan barang</label>
                <textarea class="form-control" id="asalbarang" rows="4" name="asalbarang">{{$barangkeluar->tujuan}}</textarea>
              </div>
              <div class="form-group">
                <label for="tanggalmasuk">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggalmasuk" name="tanggalmasuk" value="{{$barangkeluar->tanggalkeluar}}">
              </div>

            </form>
          </div>
        </div>
      </div>
</div>
@endsection
