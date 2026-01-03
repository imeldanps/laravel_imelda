<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori';        // Nama tabel di database
    protected $primaryKey = 'kategori_id';  // Primary key
    
    protected $fillable = ['kategori_kode', 'kategori_nama'];

    // Relasi: Satu kategori memiliki banyak barang
    public function barang(): HasMany
    {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
}