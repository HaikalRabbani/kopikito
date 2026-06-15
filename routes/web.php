<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KedaiController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\RelasiController;

// ================= ROUTE PUBLIK ================= //
Route::get('/', [PublicController::class, 'index'])->name('beranda');
Route::get('/katalog', [PublicController::class, 'katalogProduk'])->name('produk.index');
Route::get('/daftar-kedai', [PublicController::class, 'daftarKedai'])->name('kedai.index');
Route::get('/tentang-kami', [PublicController::class, 'tentangKami'])->name('tentang');
Route::get('/hubungi-kami', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/hubungi-kami', [PublicController::class, 'storeKontak'])->name('kontak.store');
Route::get('/kedai/{id}', [PublicController::class, 'detailKedai'])->name('kedai.show');

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
        $produks = \App\Models\Produk::with('kedai', 'kategori')->get();
        $kedais = \App\Models\Kedai::with('kategoris')->get();
        $pesans = \App\Models\Pesan::orderBy('created_at', 'desc')->get();
        $kategoris = \App\Models\Kategori::all();
        
        return view('admin.dashboard', compact('produks', 'kedais', 'pesans', 'kategoris')); 
    })->name('admin.dashboard'); 
    
    // 2. CRUD Data Master Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kedai', KedaiController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('pesan', PesanController::class); 
        Route::resource('kategori', KategoriController::class);   
        Route::post('/relasi', [RelasiController::class, 'store'])->name('relasi.store');
        Route::delete('/relasi/{kedai}/{kategori}', [RelasiController::class, 'destroy'])->name('relasi.destroy');
    });
});