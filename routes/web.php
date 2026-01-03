<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

// --- Route Login & Logout ---
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/level', [LevelController::class, 'index']);
        Route::post('/level/list', [LevelController::class,'list']);
        Route::get('/level/create', [LevelController::class, 'create']);
        Route::post('/level', [LevelController::class, 'store']);
        Route::get('/level/{id}/edit', [LevelController::class,'edit']);
        Route::put('/level/{id}', [LevelController::class,'update']);
        Route::delete('/level/{id}', [LevelController::class,'destroy']);
    });

    Route::group(['prefix' => 'barang', 'middleware' => 'authorize:ADM,MNG'], function () {
    Route::get('/', [BarangController::class, 'index']);          // Menampilkan halaman awal
    Route::post('/list', [BarangController::class, 'list']);      // Ambil data JSON untuk DataTables
    Route::get('/import', [BarangController::class, 'import']);             // Form upload import
    Route::post('/import_ajax', [BarangController::class, 'import_ajax']);  // Proses import excel
    Route::get('/export_excel', [BarangController::class, 'export_excel']); // Export ke Excel
    Route::get('/export_pdf', [BarangController::class, 'export_pdf']);     // Export ke PDF
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);   // Form tambah (Ajax)
    Route::post('/ajax', [BarangController::class, 'store_ajax']);          // Simpan data (Ajax)
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  // Form edit (Ajax)
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Update data (Ajax)
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Form konfirmasi hapus (Ajax)
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Proses hapus (Ajax)
});

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);          // Halaman awal User
        Route::post('/list', [UserController::class, 'list']);      // DataTables JSON
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/edit', [UserController::class, 'edit']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/{id}', [UserController::class, 'show']);
    });
});