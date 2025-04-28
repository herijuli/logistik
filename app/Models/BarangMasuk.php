<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';

    public function stok(){
        return $this->belongsTo(Stok::class,'kode_barang','kode_barang');
    }

    protected $guarded =[];
}
