@extends('master')
@section('breadcumb')
<p>Logistik / Edit barang keluar</p>
@endsection
@section('content')
<div class="row mx-auto my-2">

    {{-- Daftar error validasi --}}
@if (session('error_message') )
<div class="alert alert-danger">
    {{session('error_message')}}
</div>
@endif

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
<div class="row mx-0 my-3">
    <h1 class="text-center">
        Edit Barang Keluar
    </h1>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Edit Barang</h4>
            <form class="forms-sample" method="POST" action="{{route('barangkeluar.update',[$barangkeluar->id])}}">
                @method('PUT') @csrf
              <div class="form-group">
                <label for="kodebarang">Kode Barang</label>
                <select name="kodebarang" id="kodebarang" class=" form-control">
                    <option value="{{$barangkeluar->kode_barang}}"> {{$barangkeluar->kode_barang}}</option>
                    @if ($kodebarangs)
                        @foreach ($kodebarangs as $kodebarang)
                        <option value="{{$kodebarang}}"> {{$kodebarang}}</option>
                        @endforeach
                    @endif
                </select>
              </div>
              <div class="form-group">
                <label for="jumlahbarang">Jumlah / Quantity</label>
                <input type="text" class="form-control" id="jumlahbarang" placeholder="Masukkan Jumlah" name="jumlah" value="{{$barangkeluar->jumlah}}">
              </div>
              <div class="form-group">
                <label for="asalbarang">Tujuan barang</label>
                <textarea class="form-control" id="asalbarang" rows="4" name="tujuan">{{$barangkeluar->tujuan}}</textarea>
              </div>
              <div class="form-group">
                <label for="tanggalmasuk">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggalmasuk" name="tanggalkeluar" value="{{$barangkeluar->tanggalkeluar}}">
              </div>
              <button type="submit" class="btn btn-primary me-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
