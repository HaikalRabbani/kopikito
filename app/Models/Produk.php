<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['id_kedai', 'nama_produk', 'harga', 'jenis_kopi', 'deskripsi', 'gambar'];

    public function kedai()
    {
        return $this->belongsTo(Kedai::class, 'id_kedai');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}