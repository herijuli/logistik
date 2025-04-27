<?php

namespace Database\Seeders;

use App\Models\Stok;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stok::create([
            'kode_barang' => 'LTP-ASS-i5-PTH',
            'nama_barang' => 'Laptop Asus Core i5 Putih',
            'jumlah' => '60',
        ]);

        Stok::create([
            'kode_barang' => 'LTP-ASS-i5-HTM',
            'nama_barang' => 'Laptop Asus Core i5 Hitam',
            'jumlah' => '80',
        ]);

        Stok::create([
            'kode_barang' => 'LTP-ASS-i3-HTM',
            'nama_barang' => 'Laptop Asus Core i3 Hitam',
            'jumlah' => '30',
        ]);
    }
}
