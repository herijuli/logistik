<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Stok;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangkeluar = BarangKeluar::paginate(10);
        return view('barangkeluar.dashboardbarangkeluar',['barangkeluars' => $barangkeluar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kodebarang = Stok::pluck('kode_barang')->toArray();
        return view('barangkeluar.inputbarangkeluar',['kodebarangs' =>$kodebarang]);
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
            'tujuan' => 'required|string|max:255',
            'tanggal' => 'required',
        ]);

        if ($validator->fails()) {
            return view('barangkeluar.inputbarangkeluar',[
                'errors' => $validator->errors(),
                'error_message' => 'Validasi gagal, cek inputan Anda.',
                'kodebarangs' => $kodebarang,
            ]);
        }

        $jumlahstok = Stok::where('kode_barang', $request->kodebarang)->sum('jumlah');


        $totalstok = $jumlahstok - $request->jumlahbarang;
        Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $totalstok]);

        BarangKeluar::create([
            'kode_barang' => $request->kodebarang,
            'jumlah' => $request->jumlahbarang,
            'tujuan' => $request->tujuan,
            'tanggalkeluar' => $request->tanggal,
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
        $barangkeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.detailbarangkeluar',['barangkeluar' => $barangkeluar] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kodebarang = Stok::pluck('kode_barang')->toArray();
        $barangkeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.editbarangkeluar',['kodebarangs' => $kodebarang, 'barangkeluar' => $barangkeluar]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barangkeluar= BarangKeluar::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'kodebarang' => 'required|',
            'jumlah' => 'required|integer',
            'tujuan' => 'required|string|max:255',
            'tanggalkeluar' => 'required',
        ]);

        $kodebarang = Stok::pluck('kode_barang')->toArray();
        if ($validator->fails()) {
            return view('barangkeluar.editbarangkeluar',[
                'errors' => $validator->errors(),
                'error_message' => 'Validasi gagal, cek inputan Anda.',
                'kodebarangs' => $kodebarang,
                'barangkeluar' => $barangkeluar,
            ]);
        }


        $jumlahawal=$barangkeluar->jumlah;
        if ($jumlahawal > $request->jumlah) {
            $selisihjumlah = $jumlahawal - $request->jumlah;
            $jumlahstok = Stok::where('kode_barang', $request->kodebarang)->sum('jumlah');
            $stokakhir = $jumlahstok + $selisihjumlah;
            Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $stokakhir]);
            BarangKeluar::where('id', $id)
            ->update([
                'kode_barang' =>$request->kodebarang,
                'jumlah' =>$request->jumlah,
                'tujuan' =>$request->tujuan,
                'tanggalkeluar' =>$request->tanggalkeluar,]);
        }
        else{
            $selisihjumlah = $request->jumlah - $jumlahawal  ;
            $jumlahstok = Stok::where('kode_barang', $request->kodebarang)->sum('jumlah');
            if ($jumlahawal !== 0) {
                $stokakhir = $jumlahstok - $selisihjumlah;
                Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $stokakhir]);
                BarangKeluar::where('id', $id)
                ->update([
                    'kode_barang' =>$request->kodebarang,
                    'jumlah' =>$request->jumlah,
                    'tujuan' =>$request->tujuan,
                    'tanggalkeluar' =>$request->tanggalkeluar,
                ]);
            }
            else{
                $stokakhir = $jumlahstok - $request->jumlah;
                Stok::where('kode_barang', $request->kodebarang)->update(['jumlah' => $stokakhir]);
                BarangKeluar::where('id', $id)
                ->update([
                    'kode_barang' =>$request->kodebarang,
                    'jumlah' =>$request->jumlah,
                    'tujuan' =>$request->tujuan,
                    'tanggalkeluar' =>$request->tanggalkeluar,
                ]);
            }
        }

        $barangkeluar2= BarangKeluar::findOrFail($id);
        return view('barangkeluar.editbarangkeluar', [
            'success_message' => 'Data berhasil disimpan.',
            'kodebarangs' => $kodebarang,
            'barangkeluar' => $barangkeluar2,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangkeluar= BarangKeluar::findOrFail($id);
        $jumlahawal=$barangkeluar->jumlah;
        $jumlahstok = Stok::where('kode_barang', $barangkeluar->kode_barang)->sum('jumlah');
        $stokakhir = $jumlahstok + $jumlahawal;
        Stok::where('kode_barang', $barangkeluar->kode_barang)->update(['jumlah' => $stokakhir]);

        $barangkeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success_message','Data berhasil dihapus');
    }

    public function finds(Request $request){
        $validator = Validator::make($request->all(),[
            'selectkriteria' => 'required',
            'tanggalkeluar' => 'required_if:selectkriteria,tanggal',
            'kodebarang' => 'required_if:selectkriteria,kodebarang',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barangkeluar.index',['errors' => $validator->errors()])->with('error_message','Data tidak ditemukan.');

        }
         // nilai dari selectkriteria
         $selectKriteria = $request->get('selectkriteria');
         if($selectKriteria) {

            if ($selectKriteria == 'tanggal') {
                $barangkeluars = BarangKeluar::where('tanggalkeluar',$request->tanggalkeluar)->paginate(10);
                return view('barangkeluar.dashboardbarangkeluar',['barangkeluars' => $barangkeluars]);
            } elseif ($selectKriteria == 'kodebarang') {
                $barangkeluars = BarangKeluar::where('kode_barang',$request->kodebarang)->paginate(10);
                return view('barangkeluar.dashboardbarangkeluar',['barangkeluars' => $barangkeluars]);
            }
         }
    }
}
