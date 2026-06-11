<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kedai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KedaiController extends Controller
{
    // 1. Tampilkan daftar kedai
    public function index()
    {
        $kedai = Kedai::all();
        return view('admin.kedai.index', compact('kedai'));
    }

    // 2. Tampilkan form tambah kedai
    public function create()
    {
        return view('admin.kedai.create');
    }

    // 3. Simpan data kedai baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kedai' => 'required|string|max:255',
            'alamat' => 'required',
            'kontak' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        $data = $request->all();

        // Cek kalau ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke folder storage/app/public/kedai
            $data['gambar'] = $request->file('gambar')->store('kedai', 'public');
        }

        Kedai::create($data);

        return redirect()->route('admin.kedai.index')->with('success', 'Data Kedai berhasil ditambahkan!');
    }

    // 4. Tampilkan form edit kedai
    public function edit(Kedai $kedai)
    {
        return view('admin.kedai.edit', compact('kedai'));
    }

    // 5. Update data kedai ke database
    public function update(Request $request, Kedai $kedai)
    {
        $request->validate([
            'nama_kedai' => 'required|string|max:255',
            'alamat' => 'required',
            'kontak' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Cek kalau admin upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dulu dari storage kalau ada
            if ($kedai->gambar) {
                Storage::disk('public')->delete($kedai->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('kedai', 'public');
        }

        $kedai->update($data);

        return redirect()->route('admin.kedai.index')->with('success', 'Data Kedai berhasil diupdate!');
    }

    // 6. Hapus data kedai
    public function destroy(Kedai $kedai)
    {
        // Hapus file gambar di storage
        if ($kedai->gambar) {
            Storage::disk('public')->delete($kedai->gambar);
        }
        
        $kedai->delete();

        return redirect()->route('admin.kedai.index')->with('success', 'Data Kedai berhasil dihapus!');
    }
}