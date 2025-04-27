<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table ='barangkeluars';

    public function stok(){
        return $this->belongsTo(Stok::class,'kode_barang','kode_barang');
    }

    protected $guarded =[];
}
