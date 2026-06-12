<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\KedaiController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\AuthController;

// ================= ROUTE PUBLIK ================= //
Route::get('/', [PublicController::class, 'index'])->name('beranda');
Route::get('/daftar-kedai', [PublicController::class, 'daftarKedai'])->name('kedai.index');
Route::get('/katalog-produk', [PublicController::class, 'katalogProduk'])->name('produk.index');
Route::get('/hubungi-kami', [PublicController::class, 'hubungiKami'])->name('kontak');
Route::get('/tentang-kami', [PublicController::class, 'tentangKami'])->name('tentang');
Route::post('/kirim-pesan', [PublicController::class, 'kirimPesan'])->name('pesan.kirim');
Route::get('/hubungi-kami', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/hubungi-kami', [PublicController::class, 'storeKontak'])->name('kontak.store');

// ================= ROUTE ADMIN ================= //
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kedai', KedaiController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('pesan', PesanController::class); 
});

// Route khusus yang BELUM login (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/admin-login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin-login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/admin-register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/admin-register', [AuthController::class, 'register'])->name('register.post');
});

// Route khusus yang SUDAH login (Admin)
Route::middleware('auth')->group(function () {
    Route::post('/admin-logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/admin', function () {
        return "Ini halaman Dashboard Admin sementara! Jika lu lihat ini, berarti Login sukses.";
    })->name('admin.dashboard'); 
});