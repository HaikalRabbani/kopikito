<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kedai;
use App\Models\Produk;
use App\Models\Pesan;

class PublicController extends Controller
{
    // Nampilin Beranda
    public function index()
    {
        return view('beranda');
    }

    // Nampilin Daftar Kedai
    public function daftarKedai()
    {
        $kedai = Kedai::all();
        return view('daftar-kedai', compact('kedai'));
    }

    // Nampilin Katalog Produk
    public function katalogProduk()
    {
        // Panggil produk beserta data kedainya (biar ketahuan ini kopi dari kedai mana)
        $produk = Produk::with('kedai')->get();
        return view('katalog-produk', compact('produk'));
    }

    // Nampilin Form Hubungi Kami
    public function hubungiKami()
    {
        return view('hubungi-kami');
    }

    // Nampilin Tentang Kami
    public function tentangKami()
    {
        return view('tentang-kami');
    }

    // Fungsi buat nyimpen pesan dari pengunjung
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'isi_pesan' => 'required'
        ]);

        Pesan::create($request->all());

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }

    // Menampilkan halaman form kontak
    public function kontak()
    {
        return view('hubungi-kami');
    }

    // Memproses data form kontak ke database
    public function storeKontak(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        Pesan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'isi_pesan' => $request->pesan,
        ]);

        // Mengirim notifikasi sukses 
        return back()->with('success', 'Pesan kamu berhasil dikirim! Kami akan segera menghubungi kamu.');
    }
}