<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'SUP01', 'supplier_nama' => 'PT. ABC Indonesia', 'supplier_alamat' => 'Jl. Merdeka 10, Jakarta'],
            ['supplier_id' => 2, 'supplier_kode' => 'SUP02', 'supplier_nama' => 'CV. Jaya Abadi', 'supplier_alamat' => 'Jl. Sudirman 25, Surabaya'],
            ['supplier_id' => 3, 'supplier_kode' => 'SUP03', 'supplier_nama' => 'Indofood', 'supplier_alamat' => 'Jl. Thamrin 5, Malang'],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
