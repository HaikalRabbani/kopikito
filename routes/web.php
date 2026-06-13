<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KedaiController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesanController;

// ================= ROUTE PUBLIK ================= //
Route::get('/', [PublicController::class, 'index'])->name('beranda');
Route::get('/katalog', [PublicController::class, 'katalogProduk'])->name('produk.index');
Route::get('/daftar-kedai', [PublicController::class, 'daftarKedai'])->name('kedai.index');
Route::get('/tentang-kami', [PublicController::class, 'tentangKami'])->name('tentang');
Route::get('/hubungi-kami', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/hubungi-kami', [PublicController::class, 'storeKontak'])->name('kontak.store');

// ================= ROUTE AUTHENTICATION (LOGIN/REGISTER) ================= //
// Route khusus yang BELUM login (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/admin-login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin-login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/admin-register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/admin-register', [AuthController::class, 'register'])->name('register.post');
});

// ================= ROUTE ADMIN ================= //
// Route khusus yang SUDAH login (Admin)
Route::middleware('auth')->group(function () {
    Route::post('/admin-logout', [AuthController::class, 'logout'])->name('logout');
    
    // 1. Dashboard utama admin 
    Route::get('/admin', function () {
        $produks = \App\Models\Produk::with('kedai')->get();
        $kedais = \App\Models\Kedai::all();
        // Kalau ada pesan, tambahin juga: $pesans = \App\Models\Pesan::all();
        
        return view('admin.dashboard', compact('produks', 'kedais')); 
    })->name('admin.dashboard'); 
    
    // 2. CRUD Data Master Admin pakai Route::resource
    // Nggak perlu nulis Route::post/put/delete manual karena resource otomatis bikin semuanya
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kedai', KedaiController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('pesan', PesanController::class); 
    });
});