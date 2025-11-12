<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $detail_id_counter = 1;

        $barangPrices = DB::table('m_barang')->pluck('harga_jual', 'barang_id');

        for ($i = 1; $i <= 10; $i++) {
            $randomBarangIds = $barangPrices->keys()->random(3)->all();

            foreach ($randomBarangIds as $barang_id) {
                $jumlah = rand(1, 5); 
                $harga = $barangPrices[$barang_id];

                $data[] = [
                    'detail_id' => $detail_id_counter++,
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                ];
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
