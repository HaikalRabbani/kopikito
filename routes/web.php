<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KedaiController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesanController;

// ================= ROUTE PUBLIK ================= //
// Sesuai dengan fungsi di PublicController yang udah kita bikin
Route::get('/', [PublicController::class, 'beranda'])->name('beranda');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('produk.index');
Route::get('/daftar-kedai', [PublicController::class, 'kedai'])->name('kedai.index');
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
    
    // Dashboard utama admin
    Route::get('/admin', function () {
        return "Ini halaman Dashboard Admin sementara! Jika lu lihat ini, berarti Login sukses.";
    })->name('admin.dashboard'); 
    
    // CRUD Data Master Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kedai', KedaiController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('pesan', PesanController::class); 
    });
});