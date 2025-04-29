<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Stok;
use App\Models\BarangKeluar;
class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stok = Stok::paginate(10);
        return view('stok.dashboardbarangbaru',['stoks' => $stok]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stok.inputbarangbaru');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kodebarang' => 'required|string|max:255|unique:stoks,kode_barang',
            'namabarang' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return view('stok.inputbarangbaru',[
                'errors' => $validator->errors(),
                'error_message' => 'Validasi gagal, cek inputan Anda.'
            ]);
        }

        $stok = new Stok();
        $stok->kode_barang = $request->kodebarang;
        $stok->nama_barang = $request->namabarang;
        $stok->jumlah = 0;
        $stok->save();


        return view('stok.inputbarangbaru', [
            'success_message' => 'Data berhasil disimpan.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stok = Stok::where('kode_barang', $id)->first();
        return view('stok.detailbarangbaru',['stok' =>$stok]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stok = Stok::where('kode_barang', $id)->first();
        return view('stok.editbarangbaru',['stok'=>$stok]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update
        $validator = Validator::make($request->all(),[
            'kodebarang' => 'required|string|max:255',
            'namabarang' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return view('stok.editbarangbaru',[
                'errors' => $validator->errors(),
                'error_message' => 'Validasi gagal, cek inputan Anda.'
            ]);
        }


        $stok1 = Stok::where('kode_barang', $id)->first();
        if (!$stok1) {
            return view('stok.editbarangbaru', [
                'error_message' => 'Data tidak ditemukan.',
            ]);
        }



        $stok1->kode_barang = $request->kodebarang;
        $stok1->nama_barang = $request->namabarang;
        $stok1->save();


        $newstok = Stok::where('kode_barang',$request->kodebarang)->first();

        return view('stok.editbarangbaru', [
            'success_message' => 'Data berhasil diperbarui.',
            'stok' => $newstok
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stok = Stok::where('kode_barang',$id)->first();
        if (!$stok) {
            return redirect()->route('stok.index')->with('error_message','Data tidak ditemukan.');
        }
        $stok->delete();

        return redirect()->route('stok.index')->with('success_message','Data berhasil dihapus');
    }

    public function finds(Request $request){
        $validator = Validator::make($request->all(),[
            'selectkriteria' => 'required',
            'tanggal' => 'required_if:selectkriteria,tanggal',
            'kodebarang' => 'required_if:selectkriteria,kodebarang',
        ]);

        if ($validator->fails()) {
            dd($request->tanggal);
        }
         // Mengambil nilai dari selectkriteria d
         $selectKriteria = $request->get('selectkriteria');
         if($selectKriteria) {

            if ($selectKriteria == 'tanggal') {
                dd($request->tanggal);
                $stok = Stok::where('created_at',$request->tanggal)->paginate(10);
                return view('stok.dashboardbarangbaru',['stoks' => $stok]);
            } elseif ($selectKriteria == 'kodebarang') {
                $stok = Stok::where('kode_barang',$request->kodebarang)->paginate(10);
                return view('stok.dashboardbarangbaru',['stoks' => $stok]);
            }
         }
    }
}
