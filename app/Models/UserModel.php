<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; // PENTING: Import ini
use Tymon\JWTAuth\Contracts\JWTSubject; // (Abaikan jika belum pakai JWT)

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // Nama tabel kamu
    protected $primaryKey = 'user_id'; // Primary Key kamu
    protected $fillable = ['username', 'password', 'nama', 'level_id', 'image', 'created_at', 'updated_at'];
    protected $hidden = ['password'];


    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool
    {
        return $this->level->level_kode === $role;
    }

    public function getRole()
    {
        return $this->level->level_kode;
    }

}