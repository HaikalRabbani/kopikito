<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kedai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // 1. Tampilkan daftar produk (sekalian bawa data kedainya)
    public function index()
    {
        $produk = Produk::with('kedai')->get();
        return view('admin.produk.index', compact('produk'));
    }

    // 2. Tampilkan form tambah produk
    public function create()
    {
        // Ambil data kedai buat dimasukin ke dropdown pilihan kedai
        $kedai = Kedai::all();
        return view('admin.produk.create', compact('kedai'));
    }

    // 3. Simpan produk ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_kedai' => 'required|exists:kedai,id',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jenis_kopi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Proses upload gambar produk
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return back()->with('success', 'Data Produk berhasil ditambahkan!');
    }

    // 4. Tampilkan form edit produk
    public function edit(Produk $produk)
    {
        $kedai = Kedai::all();
        return view('admin.produk.edit', compact('produk', 'kedai'));
    }

    // 5. Update data produk
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'id_kedai' => 'required|exists:kedai,id',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jenis_kopi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        return back()->with('success', 'Data Produk berhasil diupdate!');    }

    // 6. Hapus produk
    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();

        return back()->with('success', 'Data Produk berhasil dihapus!');
    }
}