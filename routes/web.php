<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          // Halaman awal
    Route::post('/list', [UserController::class, 'list']);      // Data JSON DataTables
    Route::get('/create', [UserController::class, 'create']);   // Form Tambah User
    Route::post('/', [UserController::class, 'store']);         // Simpan Data User
    Route::get('/{id}', [UserController::class, 'show']);       // Detail User
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // Form Edit User
    Route::put('/{id}', [UserController::class, 'update']);     // Simpan Edit User
    Route::delete('/{id}', [UserController::class, 'destroy']); // Hapus User
});