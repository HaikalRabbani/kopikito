<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\KedaiController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesanController;

// ================= ROUTE PUBLIK ================= //
Route::get('/', [PublicController::class, 'index'])->name('beranda');
Route::get('/daftar-kedai', [PublicController::class, 'daftarKedai'])->name('kedai.index');
Route::get('/katalog-produk', [PublicController::class, 'katalogProduk'])->name('produk.index');
Route::get('/hubungi-kami', [PublicController::class, 'hubungiKami'])->name('kontak');
Route::post('/kirim-pesan', [PublicController::class, 'kirimPesan'])->name('pesan.kirim');

// ================= ROUTE ADMIN ================= //
// Nanti kita tambahin middleware 'auth' disini biar cuma admin yg bisa masuk
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kedai', KedaiController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('pesan', PesanController::class); 
});