<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stoks';

    public function barangmasuks(){
        return $this->hasMany(BarangMasuk::class,'kode_barang','kode_barang');
    }

    public function barangkeluars(){
        return $this->hasMany(BarangKeluar::class,'kode_barang','kode_barang');
    }

    protected $guarded =[];
}
