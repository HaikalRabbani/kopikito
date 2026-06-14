@extends('layouts.app')

@section('content')
<div class="min-h-screen py-20 bg-background text-foreground">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-serif text-4xl font-bold">Admin Panel</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                    Logout
                </button>
            </form>
        </div>

        @if(session('success'))
        <div class="bg-green-500/15 border border-green-500/50 text-green-700 dark:text-green-400 px-4 py-3 rounded-md mb-6 text-sm flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="bg-destructive/15 border border-destructive/50 text-destructive px-4 py-3 rounded-md mb-6 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid w-full grid-cols-5 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground mb-6 space-x-1">
            <button onclick="switchTab(event, 'tab-kategori')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all hover:text-foreground">
                Kategori
            </button>
            <button onclick="switchTab(event, 'tab-kedai')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all hover:text-foreground">
                Kedai
            </button>
            <button onclick="switchTab(event, 'tab-menu')" class="tab-btn active-tab inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all bg-background text-foreground shadow-sm">
                Menu
            </button>
            <button onclick="switchTab(event, 'tab-relasi')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all hover:text-foreground">
                Relasi
            </button>
            <button onclick="switchTab(event, 'tab-pesan')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all hover:text-foreground">
                Pesan
            </button>
        </div>

        <div class="mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
            
            <div id="tab-kategori" class="tab-content hidden space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Kelola Kategori</h2>
                    <button onclick="openModal('modal-tambah-kategori')" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Tambah Kategori
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($kategoris as $kat)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6 relative">
                        <h3 class="font-semibold text-lg mb-2">{{ $kat->nama_kategori }}</h3>
                        <p class="text-sm text-muted-foreground mb-4">{{ $kat->deskripsi }}</p>
                        <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" class="absolute top-4 right-4" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-destructive hover:bg-destructive/10 p-2 rounded-md transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10 text-muted-foreground border border-border border-dashed rounded-xl bg-muted/50">
                        Belum ada data kategori. Silakan tambah kategori terlebih dahulu.
                    </div>
                    @endforelse
                </div>
            </div>

            <div id="tab-kedai" class="tab-content hidden space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Kelola Kedai Kopi</h2>
                    <button onclick="openModal('modal-tambah-kedai')" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Tambah Kedai
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($kedais as $shop)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm">
                        <div class="flex flex-col space-y-1.5 p-6 pb-3">
                            <h3 class="font-semibold leading-none tracking-tight text-xl">{{ $shop->nama_kedai }}</h3>
                        </div>
                        <div class="p-6 pt-0 space-y-4">
                            <p class="text-sm text-muted-foreground">{{ $shop->alamat }}</p>
                            <p class="text-sm">{{ $shop->deskripsi }}</p>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.kedai.destroy', $shop->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kedai ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-destructive text-destructive-foreground hover:bg-destructive/90 h-9 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center py-10 text-muted-foreground border border-border border-dashed rounded-xl bg-muted/50">
                        Belum ada data kedai.
                    </div>
                    @endforelse
                </div>
            </div>

            <div id="tab-menu" class="tab-content space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Kelola Menu Kopi</h2>
                    <button onclick="openModal('modal-tambah-produk')" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        Tambah Menu
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($produks as $item)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm">
                        <div class="flex flex-col space-y-1.5 p-6 pb-3">
                            <h3 class="font-semibold leading-none tracking-tight text-lg">{{ $item->nama_produk }}</h3>
                        </div>
                        <div class="p-6 pt-0 space-y-3">
                            <div class="text-sm">
                                <span class="text-muted-foreground">Kedai:</span> {{ $item->kedai->nama_kedai ?? 'Unknown' }}
                            </div>
                            <div class="text-sm">
                                <span class="text-muted-foreground">Kategori:</span> {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                            </div>
                            <div class="text-sm">
                                <span class="text-muted-foreground">Harga:</span> Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                            <p class="text-sm text-muted-foreground line-clamp-2">{{ $item->deskripsi }}</p>
                            
                            <div class="flex gap-2 pt-2">
                                <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-destructive text-destructive-foreground hover:bg-destructive/90 h-9 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10 text-muted-foreground border border-border border-dashed rounded-xl bg-muted/50">
                        Belum ada data menu kopi.
                    </div>
                    @endforelse
                </div>
            </div>

            <div id="tab-relasi" class="tab-content hidden space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Relasi Kategori & Kedai</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="col-span-1 rounded-xl border border-border bg-card shadow-sm p-6 h-fit">
                        <h3 class="font-semibold text-lg mb-4 text-foreground">Hubungkan Kategori</h3>
                        <form action="{{ route('admin.relasi.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-sm font-medium leading-none mb-2 block text-foreground">Pilih Kedai</label>
                                <select name="id_kedai" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-ring">
                                    <option value="" disabled selected>-- Pilih Kedai --</option>
                                    @foreach($kedais as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->nama_kedai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-medium leading-none mb-2 block text-foreground">Pilih Kategori</label>
                                <select name="id_kategori" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-ring">
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-md text-sm font-medium transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 mt-2">
                                Tambahkan Relasi
                            </button>
                        </form>
                    </div>

                    <div class="col-span-1 lg:col-span-2 rounded-xl border border-border bg-card shadow-sm p-6">
                        <h3 class="font-semibold text-lg mb-4 text-foreground">Kategori per Kedai</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($kedais as $shop)
                                <div class="border border-border rounded-lg p-4 bg-muted/20">
                                    <h4 class="font-medium text-foreground mb-3">{{ $shop->nama_kedai }}</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($shop->kategoris as $kat)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                                                {{ $kat->nama_kategori }}
                                                <form action="{{ route('admin.relasi.destroy', [$shop->id, $kat->id]) }}" method="POST" class="inline" onsubmit="return confirm('Lepas kategori ini dari kedai?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:text-destructive focus:outline-none text-primary/70 transition-colors hover:text-red-500">
                                                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                                    </button>
                                                </form>
                                            </span>
                                        @empty
                                            <span class="text-xs text-muted-foreground italic">Belum ada relasi kategori.</span>
                                        @endforelse
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center text-sm text-muted-foreground">Belum ada data kedai.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-pesan" class="tab-content hidden space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Pesan Masuk</h2>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    @forelse($pesans as $msg)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6 relative overflow-hidden">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $msg->nama }}</h3>
                                <div class="flex items-center text-sm text-muted-foreground mt-1 space-x-2">
                                    <span>{{ $msg->email }}</span>
                                    <span>•</span>
                                    <span>{{ $msg->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                            <form action="{{ route('admin.pesan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus pesan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-destructive/10 text-destructive h-9 w-9">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                        <div class="pt-4 border-t border-border">
                            <p class="text-sm leading-relaxed">{{ $msg->pesan }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 text-muted-foreground border border-border border-dashed rounded-xl bg-muted/50">
                        Belum ada pesan masuk dari pengunjung.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

<div id="modal-tambah-kategori" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 transition-opacity">
    <div class="bg-background rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto border border-border">
        <div class="flex flex-col space-y-1.5 p-6 border-b border-border">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold leading-none tracking-tight text-lg text-foreground">Tambah Kategori</h3>
                <button type="button" onclick="closeModal('modal-tambah-kategori')" class="text-muted-foreground hover:text-foreground rounded-sm opacity-70 transition-opacity focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
        <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium mb-2 block text-foreground">Nama Kategori</label>
                <input type="text" name="nama_kategori" required placeholder="Contoh: Espresso Based" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block text-foreground">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
            </div>
            <div class="pt-4">
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-tambah-kedai" class="fixed inset-0 z-[60] hidden bg-black/80 flex items-center justify-center p-4 transition-opacity">
    <div class="bg-background rounded-lg shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto border border-border">
        <div class="flex flex-col space-y-1.5 p-6 border-b border-border">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold leading-none tracking-tight text-lg text-foreground">Tambah Kedai</h3>
                <button type="button" onclick="closeModal('modal-tambah-kedai')" class="text-muted-foreground hover:text-foreground rounded-sm opacity-70 transition-opacity focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
        <form action="{{ route('admin.kedai.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div><label class="text-sm font-medium mb-2 block text-foreground">Nama Kedai</label><input type="text" name="nama_kedai" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
            <div><label class="text-sm font-medium mb-2 block text-foreground">Alamat</label><input type="text" name="alamat" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
            <div><label class="text-sm font-medium mb-2 block text-foreground">Deskripsi</label><textarea name="deskripsi" required rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea></div>
            <div>
                <label class="text-sm font-medium mb-2 block text-foreground">Gambar</label>
                <div class="space-y-3">
                    <div id="preview-container-kedai" class="relative w-full h-48 rounded-lg overflow-hidden border border-input hidden bg-muted">
                        <img id="preview-kedai" src="" alt="Preview" class="w-full h-full object-cover" />
                        <button type="button" onclick="clearFileKedai()" class="absolute top-2 right-2 inline-flex items-center justify-center rounded-md text-sm font-medium bg-destructive text-destructive-foreground hover:bg-destructive/90 h-10 w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>
                    <input type="file" id="input-gambar-kedai" name="gambar" accept="image/*" onchange="previewImageKedai(event)" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:rounded-sm file:border-0 file:bg-muted file:px-4 file:py-1 hover:file:bg-accent focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                </div>
            </div>
            <div><label class="text-sm font-medium mb-2 block text-foreground">Map URL</label><textarea name="map_url" rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm"></textarea></div>
            <div class="pt-4"><button type="submit" class="inline-flex w-full items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">Tambah Kedai</button></div>
        </form>
    </div>
</div>

<div id="modal-tambah-produk" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 transition-opacity">
    <div class="bg-background rounded-lg shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto border border-border">
        <div class="flex flex-col space-y-1.5 p-6 border-b border-border">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold leading-none tracking-tight text-lg text-foreground">Tambah Menu</h3>
                <button type="button" onclick="closeModal('modal-tambah-produk')" class="text-muted-foreground hover:text-foreground rounded-sm opacity-70 transition-opacity focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium mb-2 block text-foreground">Kedai</label>
                    <select name="id_kedai" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-ring">
                        <option value="" disabled selected>Pilih kedai</option>
                        @foreach($kedais as $kedai)
                            <option value="{{ $kedai->id }}">{{ $kedai->nama_kedai }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium mb-2 block text-foreground">Kategori</label>
                    <select name="id_kategori" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-ring">
                        <option value="" disabled selected>Pilih kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div><label class="text-sm font-medium mb-2 block text-foreground">Nama Menu</label><input type="text" name="nama_produk" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
            <div><label class="text-sm font-medium mb-2 block text-foreground">Deskripsi</label><textarea name="deskripsi" required rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea></div>
            <div><label class="text-sm font-medium mb-2 block text-foreground">Harga (Rp)</label><input type="number" name="harga" required min="0" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
            <div>
                <label class="text-sm font-medium mb-2 block text-foreground">Gambar</label>
                <div class="space-y-3">
                    <div id="image-preview-container" class="relative w-full h-48 rounded-lg overflow-hidden border border-input hidden bg-muted">
                        <img id="image-preview" src="" alt="Preview" class="w-full h-full object-cover" />
                        <button type="button" onclick="clearFile()" class="absolute top-2 right-2 inline-flex items-center justify-center rounded-md text-sm font-medium bg-destructive text-destructive-foreground hover:bg-destructive/90 h-10 w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>
                    <input type="file" id="gambar-input" name="gambar" accept="image/*" onchange="previewImage(event)" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:rounded-sm file:border-0 file:bg-muted file:px-4 file:py-1 hover:file:bg-accent focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                </div>
            </div>
            <div class="pt-4"><button type="submit" class="inline-flex w-full items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">Tambah Menu</button></div>
        </form>
    </div>
</div>

<script>
    // 1. Script Pindah Tab
    function switchTab(event, tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('bg-background', 'text-foreground', 'shadow-sm', 'active-tab');
            el.classList.add('hover:text-foreground');
        });
        document.getElementById(tabId).classList.remove('hidden');
        event.currentTarget.classList.remove('hover:text-foreground');
        event.currentTarget.classList.add('bg-background', 'text-foreground', 'shadow-sm', 'active-tab');
    }

    // 2. Script Buka Tutup Modal Umum
    function openModal(modalId) { document.getElementById(modalId).classList.remove('hidden'); }
    function closeModal(modalId) { document.getElementById(modalId).classList.add('hidden'); }

    // 3. Script Preview & Clear Gambar untuk Menu
    function previewImage(event) {
        const input = event.target; const container = document.getElementById('image-preview-container'); const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; container.classList.remove('hidden'); }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function clearFile() {
        document.getElementById('gambar-input').value = ''; document.getElementById('image-preview').src = ''; document.getElementById('image-preview-container').classList.add('hidden');
    }

    // 4. Script Preview & Clear Gambar untuk Kedai
    function previewImageKedai(event) {
        const input = event.target; const container = document.getElementById('preview-container-kedai'); const preview = document.getElementById('preview-kedai');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; container.classList.remove('hidden'); }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function clearFileKedai() {
        document.getElementById('input-gambar-kedai').value = ''; document.getElementById('preview-kedai').src = ''; document.getElementById('preview-container-kedai').classList.add('hidden');
    }
</script>
@endsection