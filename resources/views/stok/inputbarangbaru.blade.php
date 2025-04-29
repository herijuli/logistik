@extends('master')
@section('breadcumb')
<p>Logistik / Input barang jenis baru</p>
@endsection
@section('active')
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
        Input Barang Jenis Baru
    </h1>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Form Input Barang Jenis Baru</h4>
            <form class="forms-sample" action="/stok" method="POST">
                @csrf
              <div class="form-group">
                <label for="kodebarang">Kode Barang</label>
                <input type="text" name="kodebarang" id="kodebarang" class="form-control">
              </div>
              <div class="form-group">
                <label for="namabarang">Nama Barang</label>
                <input type="text" name="namabarang" id="kodebarang" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary me-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
