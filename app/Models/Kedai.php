<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kedai extends Model
{
    protected $table = 'kedai';
    protected $fillable = ['nama_kedai', 'alamat', 'kontak', 'deskripsi', 'gambar'];

    // Relasi: Satu kedai bisa punya banyak produk kopi
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kedai');
    }
}