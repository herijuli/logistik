@extends('master')
@section('breadcumb')
<p>Logistik / Input barang keluar</p>
@endsection
@section('content')
<div class="row mx-auto my-2">
    {{-- Daftar error validasi --}}
@if (isset($errors) && $errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Pesan sukses --}}
@if (isset($success_message))
<div class="alert alert-success">
    {{ $success_message }}
</div>
@endif
</div>

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
            <form class="forms-sample" action="{{route('barangkeluar.store')}}" method="POST">
                @csrf
              <div class="form-group">
                <label for="kodebarang">Kode Barang</label>
                <select name="kodebarang" id="kodebarang" class=" form-control">
                    <option value="" > Pilih kode barang</option>
                    @if ($kodebarangs)
                        @foreach ($kodebarangs as $kodebarang)
                        <option value="{{$kodebarang}}"> {{$kodebarang}}</option>
                        @endforeach
                    @endif
                </select>
              </div>
              <div class="form-group">
                <label for="jumlah">Jumlah / Quantity</label>
                <input type="text" class="form-control" id="jumlah" placeholder="Masukkan Jumlah" name="jumlahbarang">
              </div>
              <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <textarea class="form-control" id="tujuan" rows="4" name="tujuan"></textarea>
              </div>
              <div class="form-group">
                <label for="tanggal">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
              </div>
              <button type="submit" class="btn btn-primary me-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
