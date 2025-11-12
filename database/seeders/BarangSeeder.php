<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Sapu', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Mixer', 'harga_beli' => 50000, 'harga_jual' => 60000],
            ['barang_id' => 3, 'kategori_id' => 1, 'barang_kode' => 'B003', 'barang_nama' => 'Oven', 'harga_beli' => 100000, 'harga_jual' => 150000],

            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Oishi', 'harga_beli' => 8000, 'harga_jual' => 10000],
            ['barang_id' => 5, 'kategori_id' => 2, 'barang_kode' => 'B005', 'barang_nama' => 'Pocky', 'harga_beli' => 13000, 'harga_jual' => 16000],
            ['barang_id' => 6, 'kategori_id' => 2, 'barang_kode' => 'B006', 'barang_nama' => 'Roma', 'harga_beli' => 16000, 'harga_jual' => 20000],

            ['barang_id' => 7, 'kategori_id' => 3, 'barang_kode' => 'B007', 'barang_nama' => 'Laptop', 'harga_beli' => 8000000, 'harga_jual' => 10000000],
            ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => 'B008', 'barang_nama' => 'Kamera', 'harga_beli' => 6000000, 'harga_jual' => 7000000],
            ['barang_id' => 9, 'kategori_id' => 3, 'barang_kode' => 'B009', 'barang_nama' => 'Sound System', 'harga_beli' => 25000000, 'harga_jual' => 26000000],

            ['barang_id' => 10, 'kategori_id' => 4, 'barang_kode' => 'B010', 'barang_nama' => 'Buku Tulis', 'harga_beli' => 2500, 'harga_jual' => 3500],
            ['barang_id' => 11, 'kategori_id' => 4, 'barang_kode' => 'B011', 'barang_nama' => 'Pena', 'harga_beli' => 1500, 'harga_jual' => 2500],
            ['barang_id' => 12, 'kategori_id' => 4, 'barang_kode' => 'B012', 'barang_nama' => 'Pensil', 'harga_beli' => 1000, 'harga_jual' => 2000],

            ['barang_id' => 13, 'kategori_id' => 5, 'barang_kode' => 'B013', 'barang_nama' => 'Sabun Lifebuoy', 'harga_beli' => 3000, 'harga_jual' => 4000],
            ['barang_id' => 14, 'kategori_id' => 5, 'barang_kode' => 'B014', 'barang_nama' => 'Shampo Clear', 'harga_beli' => 8000, 'harga_jual' => 10000],
            ['barang_id' => 15, 'kategori_id' => 5, 'barang_kode' => 'B015', 'barang_nama' => 'Pasta Gigi Pepsodent', 'harga_beli' => 5000, 'harga_jual' => 6500],
        ];
        DB::table('m_barang')->insert($data);
    }
}
