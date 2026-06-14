<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kedai extends Model
{
    protected $table = 'kedai';
    protected $fillable = ['nama_kedai', 'alamat', 'kontak', 'deskripsi', 'map_url', 'gambar'];

    // Relasi: Satu kedai bisa punya banyak produk kopi
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kedai');
    }
    
    // Taruh di dalam class Kedai
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_kedai', 'id_kedai', 'id_kategori');
    }
}