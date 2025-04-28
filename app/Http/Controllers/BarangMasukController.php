<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangmasuk = BarangMasuk::paginate(10);
        return view('barangmasuk.dashboardbarangmasuk',['barangmasuks' => $barangmasuk]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kodebarang = Stok::pluck('kode_barang')->toArray();
        return view('barangmasuk.inputbarang',['kodebarangs' => $kodebarang]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kodebarang = Stok::pluck('kode_barang')->toArray();
        $validator = Validator::make($request->all(),[
            'kodebarang' => 'required|',
            'jumlahbarang' => 'required|integer',
            'asalbarang' => 'required|string|max:255',
            'tanggalmasuk' => 'required',
        ]);

        if ($validator->fails()) {
            return view('barangmasuk.inputbarang',[
                'errors' => $validator->errors(),
                'error_message' => 'Validasi gagal, cek inputan Anda.',
                'kodebarangs' => $kodebarang,
            ]);
        }

        $jumlahstok = Stok::where('kode_barang', $request->kodebarang)->sum('jumlah');


        $totalstok = $jumlahstok + $request->jumlahbarang;
        Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $totalstok]);

        BarangMasuk::create([
            'kode_barang' => $request->kodebarang,
            'jumlah' => $request->jumlahbarang,
            'asal' => $request->asalbarang,
            'tanggalmasuk' => $request->tanggalmasuk,
        ]);

        return view('barangmasuk.inputbarang', [
            'success_message' => 'Data berhasil disimpan.',
            'kodebarangs' => $kodebarang
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('barangmasuk.detailbarangmasuk');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('barangmasuk.editbarangmasuk');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
