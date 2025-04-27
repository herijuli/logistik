@extends('master')
@section('breadcumb')
<p>Logistik / Dashboard Stok Barang</p>
@endsection
@section('content')
<div class="row mx-auto my-2">
    {{-- Daftar error validasi --}}
    @if (session('error_message') )
    <div class="alert alert-danger">
        {{session('error_message')}}
    </div>
    @endif

    {{-- Pesan sukses --}}
    @if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message')}}
    </div>
    @endif
</div>

<div class="row mx-0">
    <div class="col-12 mx-auto">
        <h1 class="text-center my-3">Dashboard Stok Barang</h1>
    </div>
    <div class="col-12 col-md-9 mx-auto">
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Tampilkan data berdasarkan
                    </div>
                    <div class="form-group">
                        <label>Pilih kriteria</label>
                        <select class=" w-100 form-select" name="selectkriteria" id="selectkriteria" style="border: 1px solid black">
                          <option value="date">Tangal</option>
                          <option value="kodebarang">Kode barang</option>
                        </select>
                    </div>
                    <div class="form-group" id="tanggalmasukgroup">
                        <input class="form-control" type="date" name="tanggalmasuk" id="tanggalmasuk" style="border: 1px solid black"/>
                    </div>
                    <div class="form-group" id="kodebaranggroup">
                        <input class="form-control" type="text" name="kodebarang" id="kodebarang" placeholder="kodebrang" style="border: 1px solid black"/>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info btn-icon-text">
                            Tampilkan data
                            <i class="mdi mdi-archive-search btn-icon-append"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mx-0">
    <div class="col-12 col-md-9 mx-auto">
        <div class=" grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Daftar Barang Masuk</h4>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($stoks as $stok)
                        <tr>
                            <td>{{$stok->id}}</td>
                            <td>{{$stok->kode_barang}}</td>
                            <td>{{$stok->nama_barang}}</td>
                            <td>{{$stok->jumlah}}</i></td>
                            <td class="d-flex justify-content-between gap-1">
                                <a href="/stok/{{$stok->kode_barang}}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="/stok/{{$stok->kode_barang}}/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/stok/{{$stok->kode_barang}}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
