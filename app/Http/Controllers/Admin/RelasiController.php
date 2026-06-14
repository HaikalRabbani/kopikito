<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kedai;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    // Tambah relasi (Hubungkan)
    public function store(Request $request)
    {
        $request->validate(['id_kedai' => 'required', 'id_kategori' => 'required']);
        $kedai = Kedai::findOrFail($request->id_kedai);
        
        // syncWithoutDetaching mencegah duplikasi kalau diklik 2x
        $kedai->kategoris()->syncWithoutDetaching([$request->id_kategori]);
        
        return back()->with('success', 'Relasi Kategori & Kedai berhasil ditambahkan!');
    }

    // Hapus relasi
    public function destroy($id_kedai, $id_kategori)
    {
        $kedai = Kedai::findOrFail($id_kedai);
        $kedai->kategoris()->detach($id_kategori);
        
        return back()->with('success', 'Relasi Kategori berhasil dilepas dari Kedai!');
    }
}