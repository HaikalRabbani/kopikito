<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kedai;
use App\Models\Produk;
use App\Models\Pesan;
use App\Models\Kategori;

class PublicController extends Controller
{
    // Nampilin Beranda
    public function index()
    {
        $kategoris = Kategori::all();
        return view('beranda', compact('kategoris'));
    }

    // Nampilin Daftar Kedai
    public function daftarKedai(Request $request)
    {
        $query = Kedai::with('kategoris');

        // Logika Filter: Kalau ada param ?kategori= di URL (dari klik card beranda)
        if ($request->has('kategori') && $request->kategori != '') {
            $id_kat = $request->kategori;
            $query->whereHas('kategoris', function($q) use ($id_kat) {
                $q->where('kategori.id', $id_kat);
            });
        }

        $kedais = $query->get();
        
        // Bawa data kategori juga buat opsi dropdown filter di halamannya nanti
        $kategoris = Kategori::all(); 

        return view('daftar-kedai', compact('kedais', 'kategoris'));
    }

    // Fungsi baru untuk nampilin halaman Detail Kedai
    public function detailKedai($id)
    {
        $kedai = Kedai::with('kategoris')->findOrFail($id);
        $menus = \App\Models\Produk::with('kategori')->where('id_kedai', $id)->get();
        $kategoriIds = $kedai->kategoris->pluck('id');
        $relatedKedais = Kedai::whereHas('kategoris', function($query) use ($kategoriIds) {
            $query->whereIn('kategori.id', $kategoriIds);
        })
        ->where('id', '!=', $id)
        ->take(6)
        ->get();

        return view('detail-kedai', compact('kedai', 'menus', 'relatedKedais'));
    }

    // Nampilin Katalog Produk
   public function katalogProduk()
    {
        $kategoris = Kategori::all(); 
        
        return view('katalog-produk', compact('kategoris'));
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