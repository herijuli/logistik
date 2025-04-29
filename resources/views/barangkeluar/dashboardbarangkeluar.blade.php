@extends('master')
@section('breadcumb')
<p>Logistik / Dashboard barang keluar</p>
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
    @if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message')}}
    </div>
    @endif
</div>
<div class="row mx-0">
    <div class="col-12 mx-auto">
        <h1 class="text-center my-3">Dashboard Barang Keluar</h1>
    </div>
    <div class="col-12 col-md-9 mx-auto">
        <div class="grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Tampilkan data berdasarkan
                    </div>
                    <form action="{{route('cari-barang-keluar')}}" class="form-sample" method="GET">
                        @csrf
                    <div class="form-group">
                        <label>Pilih kriteria</label>
                        <select class=" w-100 form-select" name="selectkriteria" id="selectkriteria" style="border: 1px solid black">
                          <option value="tanggal">Tangal</option>
                          <option value="kodebarang">Kode barang</option>
                        </select>
                    </div>
                    <div class="form-group" id="tanggalmasukgroup">
                        <input class="form-control" type="date" name="tanggalkeluar" id="tanggalmasuk" style="border: 1px solid black"/>
                    </div>
                    <div class="form-group" id="kodebaranggroup">
                        <input class="form-control" type="text" name="kodebarang" id="kodebarang" placeholder="kodebrang" style="border: 1px solid black"/>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-info btn-icon-text">
                            Tampilkan data
                            <i class="mdi mdi-archive-search btn-icon-append"></i>
                        </button>
                    </div>
                    </form>
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
                <h4 class="card-title">Daftar Barang Keluar</h4>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>No. Barang Keluar</th>
                        <th>Kode Barang</th>
                        <th>Quantity</th>
                        <th>Asal barang</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $barangkeluars->count(); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$barangkeluars[$i]->id}}</td>
                            <td>{{$barangkeluars[$i]->kode_barang}}</td>
                            <td>{{$barangkeluars[$i]->jumlah}}</td>
                            <td>{{$barangkeluars[$i]->tujuan}}</td>
                            <td > {{$barangkeluars[$i]->tanggalkeluar}}</td>
                            <td class="d-flex justify-content-between gap-1">
                                <a href="{{route('barangkeluar.show',[$barangkeluars[$i]->id])}}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{route('barangkeluar.edit',[$barangkeluars[$i]->id])}}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{route('barangkeluar.destroy',[$barangkeluars[$i]->id])}}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                          </tr>
                        @endfor
                    </tbody>
                  </table>


                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKriteria = document.getElementById('selectkriteria');
        const tanggalGroup = document.getElementById('tanggalmasukgroup');
        const kodebarangGroup = document.getElementById('kodebaranggroup');

        function toggleInput() {
            if (selectKriteria.value === 'tanggal') {
                tanggalGroup.style.display = 'block';
                kodebarangGroup.style.display = 'none';
            } else if (selectKriteria.value === 'kodebarang') {
                tanggalGroup.style.display = 'none';
                kodebarangGroup.style.display = 'block';
            }
        }

        // Panggil saat pertama kali halaman dimuat
        toggleInput();

        // Panggil setiap kali select berubah
        selectKriteria.addEventListener('change', toggleInput);
    });
    </script>
@endsection
