<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Date;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'penjualan_id' => $i,
                'user_id' => 3, 
                'pembeli' => 'Pelanggan ' . $i,
                'penjualan_kode' => 'TRX00' . $i,
                'penjualan_tanggal' => Date::now()->subDays(10 - $i),
            ];
        }
        DB::table('t_penjualan')->insert($data);
    }
}
