<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    
    protected $guarded = [];
    

    // RELASI 1: Kategori ke Produk (One-to-Many)

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }

    // RELASI 2: Kategori ke Kedai (Many-to-Many) 
    public function kedais()
    {
        // Parameter: (Model Tujuan, Nama Tabel Pivot, Foreign Key Model Ini, Foreign Key Model Tujuan)
        return $this->belongsToMany(Kedai::class, 'kategori_kedai', 'id_kategori', 'id_kedai');
    }
}