@extends('master')
@section('breadcumb')
<p>Logistik / Input barang keluar</p>
@endsection
@section('content')
<div class="row mx-0 my-3">
    <h1 class="text-center">
        Input Barang Keluar
    </h1>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Input Barang</h4>
            <form class="forms-sample" action="" method="POST">
                @csrf
              <div class="form-group">
                <label for="kodebarang">Kode Barang</label>
                <select name="kodebarang" id="kodebarang" class=" form-control">
                    <option > Pilih kode barang</option>
                </select>
              </div>
              <div class="form-group">
                <label for="jumlahbarang">Jumlah / Quantity</label>
                <input type="text" class="form-control" id="jumlahbarang" placeholder="Masukkan Jumlah" name="jumlahbarang">
              </div>
              <div class="form-group">
                <label for="asalbarang">Asal barang</label>
                <textarea class="form-control" id="asalbarang" rows="4" name="asalbarang"></textarea>
              </div>
              <div class="form-group">
                <label for="tanggalmasuk">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggalmasuk" name="tanggalmasuk">
              </div>
              <button type="submit" class="btn btn-primary me-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
