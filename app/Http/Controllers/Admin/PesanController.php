<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    // 1. Tampilkan semua pesan masuk
    public function index()
    {
        // Urutkan dari pesan yang paling baru masuk (descending)
        $pesan = Pesan::orderBy('created_at', 'desc')->get();
        return view('admin.pesan.index', compact('pesan'));
    }

    // 2. Hapus pesan
    public function destroy(Pesan $pesan)
    {
        $pesan->delete();
        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus!');
    }
}