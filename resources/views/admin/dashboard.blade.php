@extends('layouts.app') <!-- Pastikan lu punya layout utama -->

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <!-- Tombol Logout -->
            <form action="{{-- route('logout') --}}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- TABS TRIGGER (Sistem Menu) -->
        <!-- Desain ini niru gaya Tabs Shadcn UI di React -->
        <div class="bg-gray-200/50 p-1 rounded-lg inline-flex mb-8 overflow-x-auto">
            <button onclick="switchTab(event, 'tab-menu')" class="tab-btn active-tab px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 bg-white shadow-sm text-gray-900">
                Menu / Produk
            </button>
            <button onclick="switchTab(event, 'tab-kategori')" class="tab-btn px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                Kategori
            </button>
            <button onclick="switchTab(event, 'tab-kedai')" class="tab-btn px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                Kedai
            </button>
            <button onclick="switchTab(event, 'tab-kategori-kedai')" class="tab-btn px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                Relasi (Shop Categories)
            </button>
            <button onclick="switchTab(event, 'tab-pesan')" class="tab-btn px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 text-gray-500 hover:text-gray-700">
                Pesan Masuk
            </button>
        </div>

        <!-- TABS CONTENT -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 min-h-[500px]">
            
            <!-- Tab 1: Menu / Produk -->
            <div id="tab-menu" class="tab-content">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Manajemen Menu & Produk</h2>
                        <p class="text-sm text-gray-500">Kelola daftar menu kopi dan produk lainnya.</p>
                    </div>
                    <!-- Tombol Tambah Produk -->
                    <button onclick="openModal('modal-tambah-produk')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition text-sm font-medium">
                        + Tambah Menu
                    </button>
                </div>

                <!-- Tabel Produk -->
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nama Menu</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Looping data dari Controller -->
                            @forelse($produks as $index => $produk)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $produk->nama_produk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-2">
                                    <!-- Tombol Edit -->
                                    <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                    
                                    <!-- Form Hapus -->
                                    <form action="{{-- route('admin.produk.destroy', $produk->id) --}}" method="POST" class="inline-block" onsubmit="return confirm('Yakin mau hapus menu ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data menu/produk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 2: Kategori -->
            <div id="tab-kategori" class="tab-content hidden">
                <h2 class="text-xl font-semibold mb-4">Manajemen Kategori</h2>
                <p class="text-gray-500">Tabel CategoriesManager.tsx versi Laravel akan ada di sini...</p>
            </div>

            <!-- Tab 3: Kedai -->
            <div id="tab-kedai" class="tab-content hidden">
                <h2 class="text-xl font-semibold mb-4">Manajemen Kedai</h2>
                <p class="text-gray-500">Tabel ShopsManager.tsx versi Laravel akan ada di sini...</p>
            </div>

            <!-- Tab 4: Relasi / Shop Categories -->
            <div id="tab-kategori-kedai" class="tab-content hidden">
                <h2 class="text-xl font-semibold mb-4">Kategori Kedai</h2>
                <p class="text-gray-500">Tabel ShopCategoriesManager.tsx versi Laravel akan ada di sini...</p>
            </div>

            <!-- Tab 5: Pesan Masuk -->
            <div id="tab-pesan" class="tab-content hidden">
                <h2 class="text-xl font-semibold mb-4">Pesan Masuk (Inbox)</h2>
                <p class="text-gray-500">Tabel MessagesViewer.tsx versi Laravel akan ada di sini...</p>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT UNTUK SPA TABS -->
<script>
    function switchTab(event, tabId) {
        // 1. Sembunyikan semua konten tab
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        // 2. Reset style semua tombol tab ke state "inactive"
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('bg-white', 'shadow-sm', 'text-gray-900', 'active-tab');
            el.classList.add('text-gray-500', 'hover:text-gray-700');
        });

        // 3. Tampilkan konten tab yang diklik
        document.getElementById(tabId).classList.remove('hidden');

        // 4. Ubah style tombol yang diklik ke state "active"
        event.currentTarget.classList.remove('text-gray-500', 'hover:text-gray-700');
        event.currentTarget.classList.add('bg-white', 'shadow-sm', 'text-gray-900', 'active-tab');
    }
</script>
@endsection