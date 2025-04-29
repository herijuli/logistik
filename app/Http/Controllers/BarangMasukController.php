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
        $barangmasuk = BarangMasuk::findOrFail($id);

        return view('barangmasuk.detailbarangmasuk',['stok' => $barangmasuk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kodebarang = Stok::pluck('kode_barang')->toArray();
        $barangmasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.editbarangmasuk',['barangmasuk' => $barangmasuk,'kodebarangs' => $kodebarang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barangmasuk= BarangMasuk::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'kodebarang' => 'required|',
            'jumlah' => 'required|integer',
            'asalbarang' => 'required|string|max:255',
            'tanggalmasuk' => 'required',
        ]);

        $kodebarang = Stok::pluck('kode_barang')->toArray();
        if ($validator->fails()) {
            return view('barangmasuk.editbarangmasuk',[
                'errors' => $validator->errors(),
                'error_message' => 'Validasi gagal, cek inputan Anda.',
                'kodebarangs' => $kodebarang,
                'barangmasuk' => $barangmasuk,
            ]);
        }


        $jumlahawal=$barangmasuk->jumlah;
        if ($jumlahawal > $request->jumlah) {
            $selisihjumlah = $jumlahawal - $request->jumlah;
            $jumlahstok = Stok::where('kode_barang', $request->kodebarang)->sum('jumlah');
            $stokakhir = $jumlahstok - $selisihjumlah;
            Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $stokakhir]);
            BarangMasuk::where('id', $id)
            ->update([
                'kode_barang' =>$request->kodebarang,
                'jumlah' =>$request->jumlah,
                'asal' =>$request->asalbarang,
                'tanggalmasuk' =>$request->tanggalmasuk,]);
        }
        else{
            $selisihjumlah = $request->jumlah - $jumlahawal  ;
            $jumlahstok = Stok::where('kode_barang', $request->kodebarang)->sum('jumlah');
            if ($jumlahawal !== 0) {
                $stokakhir = $jumlahstok + $selisihjumlah;
                Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $stokakhir]);
                BarangMasuk::where('id', $id)
                ->update([
                    'kode_barang' =>$request->kodebarang,
                    'jumlah' =>$request->jumlah,
                    'asal' =>$request->asalbarang,
                    'tanggalmasuk' =>$request->tanggalmasuk,
                ]);
            }
            else{
                $stokakhir = $jumlahstok + $request->jumlah;
                Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $stokakhir]);
                BarangMasuk::where('id', $id)
                ->update([
                    'kode_barang' =>$request->kodebarang,
                    'jumlah' =>$request->jumlah,
                    'asal' =>$request->asalbarang,
                    'tanggalmasuk' =>$request->tanggalmasuk,
                ]);
            }
        }

        $barangmasuk2= BarangMasuk::findOrFail($id);
        return view('barangmasuk.editbarangmasuk', [
            'success_message' => 'Data berhasil disimpan.',
            'kodebarangs' => $kodebarang,
            'barangmasuk' => $barangmasuk2,
        ]);

        // jika jumlah awal lebih besar ketimbang jumlah baru maka update jumlah barang masuk dan kurangin jumlah stok dengan selisih begitu sebaliknya

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $barangmasuk= BarangMasuk::findOrFail($id);
        $jumlahawal=$barangmasuk->jumlah;
        $jumlahstok = Stok::where('kode_barang', $barangmasuk->kode_barang)->sum('jumlah');
        $stokakhir = $jumlahstok - $jumlahawal;
        Stok::where('kode_barang', $barangmasuk->kode_barang)->update(['jumlah' => $stokakhir]);

        $barangmasuk->delete();

        return redirect()->route('barangmasuk.index')->with('success_message','Data berhasil dihapus');
        //ambil jumlah barangmasuk untuk di kurangkan dengan jumlah stok
        // lalu update jumlah stok barang master
    }

    public function finds(Request $request){
        $validator = Validator::make($request->all(),[
            'selectkriteria' => 'required',
            'tanggalmasuk' => 'required_if:selectkriteria,tanggal',
            'kodebarang' => 'required_if:selectkriteria,kodebarang',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangmasuk.index',['errors' => $validator->errors()])->with('error_message','Data tidak ditemukan.');

        }
         // nilai dari selectkriteria
         $selectKriteria = $request->get('selectkriteria');
         if($selectKriteria) {

            if ($selectKriteria == 'tanggal') {
                $barangmasuks = BarangMasuk::where('tanggalmasuk',$request->tanggalmasuk)->paginate(10);
                return view('barangmasuk.dashboardbarangmasuk',['barangmasuks' => $barangmasuks]);
            } elseif ($selectKriteria == 'kodebarang') {
                $barangmasuks = BarangMasuk::where('kode_barang',$request->kodebarang)->paginate(10);
                return view('barangmasuk.dashboardbarangmasuk',['barangmasuks' => $barangmasuks]);
            }
         }
    }
}
