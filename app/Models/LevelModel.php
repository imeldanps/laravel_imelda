<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';        // Nama tabel di database
    protected $primaryKey = 'level_id';  // Primary key
    
    // SOLUSI ERROR MASS ASSIGNMENT:
    // Kita harus mendaftarkan kolom mana saja yang boleh diisi secara massal (create/update)
    protected $fillable = [
        'level_kode', 
        'level_nama'
    ];

    // Relasi: Satu Level memiliki banyak User
    public function user(): HasMany
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}