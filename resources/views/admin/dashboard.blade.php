@extends('layouts.app')

@section('content')
<div class="min-h-screen py-20 bg-background text-foreground">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-serif text-4xl font-bold">Admin Panel</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 transition-colors">
                    Logout
                </button>
            </form>
        </div>

        @if(session('success'))
        <div class="bg-green-500/15 border border-green-500/50 text-green-700 dark:text-green-400 px-4 py-3 rounded-md mb-6 text-sm flex items-center">
            <svg class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
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
            <button onclick="switchTab(event, 'tab-kategori')" class="tab-btn active-tab inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all bg-background text-foreground shadow-sm">Kategori</button>
            <button onclick="switchTab(event, 'tab-kedai')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all hover:text-foreground">Kedai</button>
            <button onclick="switchTab(event, 'tab-menu')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all hover:text-foreground">Menu</button>
            <button onclick="switchTab(event, 'tab-relasi')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all hover:text-foreground">Relasi</button>
            <button onclick="switchTab(event, 'tab-pesan')" class="tab-btn inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium transition-all hover:text-foreground">Pesan</button>
        </div>

        <div class="mt-2">
            
            <div id="tab-kategori" class="tab-content space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Kelola Kategori</h2>
                    <button onclick="openModal('modal-kategori')" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 transition-colors">
                        Tambah Kategori
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @forelse($kategoris as $kat)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6 relative">
                        @if($kat->gambar)
                            <div class="w-12 h-12 rounded-md overflow-hidden mb-3 border border-border">
                                <img src="{{ asset('storage/' . $kat->gambar) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <h3 class="font-semibold text-lg mb-2">{{ $kat->nama_kategori }}</h3>
                        <p class="text-sm text-muted-foreground mb-4">{{ $kat->deskripsi }}</p>
                        
                        <div class="absolute top-4 right-4 flex items-center gap-1">
                            <button type="button" 
                                onclick="editKategori(this)" 
                                data-id="{{ $kat->id }}" 
                                data-nama="{{ $kat->nama_kategori }}" 
                                data-deskripsi="{{ $kat->deskripsi }}" 
                                class="text-blue-500 hover:bg-blue-500/10 p-2 rounded-md transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </button>
                            <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-destructive hover:bg-destructive/10 p-2 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10 text-muted-foreground border border-border border-dashed rounded-xl bg-muted/50">
                        Belum ada data kategori.
                    </div>
                    @endforelse
                </div>
            </div>

            <div id="tab-kedai" class="tab-content hidden space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Kelola Kedai Kopi</h2>
                    <button onclick="openModal('modal-kedai')" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 transition-colors">
                        Tambah Kedai
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($kedais as $shop)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm overflow-hidden flex flex-col">
                        
                        <div class="aspect-video w-full bg-muted relative overflow-hidden border-b border-border">
                            @if($shop->gambar)
                                <img src="{{ asset('storage/' . $shop->gambar) }}" alt="{{ $shop->nama_kedai }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex flex-col items-center justify-center w-full h-full text-muted-foreground opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    <span class="text-sm">Belum ada foto</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="font-bold text-xl mb-1">{{ $shop->nama_kedai }}</h3>
                            <p class="text-sm text-muted-foreground mb-3 flex items-start gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0 mt-0.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $shop->alamat }}
                            </p>
                            <p class="text-sm line-clamp-2 mb-4">{{ $shop->deskripsi }}</p>

                            @if($shop->map_url)
                                <div class="mb-5 rounded-lg overflow-hidden border border-border aspect-video w-full bg-muted [&>iframe]:w-full [&>iframe]:h-full">
                                    {!! $shop->map_url !!}
                                </div>
                            @endif

                            <div class="flex gap-2 mt-auto pt-4 border-t border-border">
                                <button type="button" 
                                    onclick="editKedai(this)" 
                                    data-id="{{ $shop->id }}"
                                    data-nama="{{ $shop->nama_kedai }}"
                                    data-alamat="{{ $shop->alamat }}"
                                    data-deskripsi="{{ $shop->deskripsi }}"
                                    data-map="{{ $shop->map_url }}"
                                    class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-input bg-background hover:bg-accent h-9 px-4 w-full">
                                    Edit
                                </button>
                                <form action="{{ route('admin.kedai.destroy', $shop->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kedai ini?');" class="w-full">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-destructive text-destructive-foreground hover:bg-destructive/90 h-9 px-4 w-full">
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

            <div id="tab-menu" class="tab-content hidden space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-semibold">Kelola Menu Kopi</h2>
                    <button onclick="openModal('modal-produk')" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 transition-colors">
                        Tambah Menu
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($produks as $item)
                    <div class="rounded-xl border border-border bg-card text-card-foreground shadow-sm">
                        <div class="p-6 pb-3">
                            <h3 class="font-semibold text-lg">{{ $item->nama_produk }}</h3>
                        </div>
                        <div class="p-6 pt-0 space-y-3">
                            <div class="text-sm"><span class="text-muted-foreground">Kedai:</span> {{ $item->kedai->nama_kedai ?? 'Unknown' }}</div>
                            <div class="text-sm"><span class="text-muted-foreground">Kategori:</span> {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}</div>
                            <div class="text-sm"><span class="text-muted-foreground">Harga:</span> Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                            <p class="text-sm text-muted-foreground line-clamp-2">{{ $item->deskripsi }}</p>
                            
                            <div class="flex gap-2 pt-2">
                                <button type="button" 
                                    onclick="editProduk(this)"
                                    data-id="{{ $item->id }}"
                                    data-kedai="{{ $item->id_kedai }}"
                                    data-kategori="{{ $item->id_kategori }}"
                                    data-nama="{{ $item->nama_produk }}"
                                    data-deskripsi="{{ $item->deskripsi }}"
                                    data-harga="{{ $item->harga }}"
                                    class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-input bg-background hover:bg-accent h-9 px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg> Edit
                                </button>
                                <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-destructive text-destructive-foreground hover:bg-destructive/90 h-9 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg> Hapus
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
                <h2 class="text-2xl font-serif font-semibold">Relasi Kategori & Kedai</h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="col-span-1 rounded-xl border border-border bg-card p-6 h-fit">
                        <h3 class="font-semibold text-lg mb-4">Hubungkan Kategori</h3>
                        <form action="{{ route('admin.relasi.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="text-sm font-medium mb-2 block">Pilih Kedai</label>
                                <select name="id_kedai" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                                    <option value="" disabled selected>-- Pilih Kedai --</option>
                                    @foreach($kedais as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->nama_kedai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-medium mb-2 block">Pilih Kategori</label>
                                <select name="id_kategori" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-primary text-primary-foreground h-10 rounded-md text-sm font-medium mt-2">
                                Tambahkan Relasi
                            </button>
                        </form>
                    </div>

                    <div class="col-span-1 lg:col-span-2 rounded-xl border border-border bg-card p-6">
                        <h3 class="font-semibold text-lg mb-4">Kategori per Kedai</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($kedais as $shop)
                            <div class="border border-border rounded-lg p-4 bg-muted/20">
                                <h4 class="font-medium mb-3">{{ $shop->nama_kedai }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($shop->kategoris as $kat)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-primary/10 text-primary border border-primary/20">
                                            {{ $kat->nama_kategori }}
                                            <form action="{{ route('admin.relasi.destroy', [$shop->id, $kat->id]) }}" method="POST" class="inline" onsubmit="return confirm('Lepas kategori ini?');">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="hover:text-red-500 font-bold ml-1">×</button>
                                            </form>
                                        </span>
                                    @empty
                                        <span class="text-xs text-muted-foreground italic">Belum ada relasi.</span>
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
                <h2 class="text-2xl font-serif font-semibold">Pesan Masuk</h2>
                <div class="grid grid-cols-1 gap-4">
                    @forelse($pesans as $msg)
                    <div class="rounded-xl border border-border bg-card p-6 relative">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $msg->nama }}</h3>
                                <div class="text-sm text-muted-foreground mt-1">{{ $msg->email }} • {{ $msg->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <form action="{{ route('admin.pesan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesan?');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-destructive hover:text-red-700 font-medium text-sm">Hapus</button>
                            </form>
                        </div>
                        <p class="text-sm pt-4 border-t border-border">{{ $msg->pesan }}</p>
                    </div>
                    @empty 
                        <div class="text-center py-10 text-muted-foreground border border-border border-dashed rounded-xl bg-muted/50">Belum ada pesan masuk.</div> 
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

<div id="modal-kategori" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4">
    <div class="bg-background rounded-lg shadow-lg w-full max-w-md border border-border">
        <div class="p-6 border-b border-border flex justify-between items-center">
            <h3 id="title-kategori" class="font-semibold text-lg">Tambah Kategori</h3>
            <button type="button" onclick="closeModal('modal-kategori')" class="text-muted-foreground hover:text-foreground">✕</button>
        </div>
        <form id="form-kategori" method="POST" action="{{ route('admin.kategori.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf 
            <input type="hidden" name="_method" id="method-kategori" value="POST">
            <div>
                <label class="text-sm font-medium mb-2 block">Nama Kategori</label>
                <input type="text" id="input_nama_kategori" name="nama_kategori" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Deskripsi</label>
                <textarea name="deskripsi" id="input_deskripsi_kategori" rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Gambar Kategori (Opsional)</label>
                <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:rounded-sm file:border-0 file:bg-muted file:px-4 file:py-1 cursor-pointer">
            </div>
            <button type="submit" class="w-full bg-primary text-primary-foreground h-10 rounded-md text-sm font-medium mt-4">Simpan</button>
        </form>
    </div>
</div>

<div id="modal-kedai" class="fixed inset-0 z-[60] hidden bg-black/80 flex items-center justify-center p-4">
    <div class="bg-background rounded-lg shadow-lg w-full max-w-2xl border border-border max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-border flex justify-between items-center">
            <h3 id="title-kedai" class="font-semibold text-lg">Tambah Kedai</h3>
            <button type="button" onclick="closeModal('modal-kedai')" class="text-muted-foreground hover:text-foreground">✕</button>
        </div>
        <form id="form-kedai" method="POST" action="{{ route('admin.kedai.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf 
            <input type="hidden" name="_method" id="method-kedai" value="POST">
            <div>
                <label class="text-sm font-medium mb-2 block">Nama Kedai</label>
                <input type="text" id="input_nama_kedai" name="nama_kedai" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Alamat</label>
                <input type="text" id="input_alamat_kedai" name="alamat" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Deskripsi</label>
                <textarea id="input_deskripsi_kedai" name="deskripsi" required rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Foto Kedai (Opsional)</label>
                <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:rounded-sm file:border-0 file:bg-muted file:px-4 file:py-1 cursor-pointer">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block text-blue-600 dark:text-blue-400">Google Maps Embed HTML (Iframe)</label>
                <textarea id="input_map_kedai" name="map_url" rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?..."></iframe>' class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm"></textarea>
                <p class="text-xs text-muted-foreground mt-1 font-medium">
                    *Cara: Buka Google Maps > Cari Kedai > Klik Bagikan > Sematkan Peta > Copy HTML > Paste kesini.
                </p>
            </div>
            <button type="submit" class="w-full bg-primary text-primary-foreground h-10 rounded-md text-sm font-medium mt-4">Simpan</button>
        </form>
    </div>
</div>

<div id="modal-produk" class="fixed inset-0 z-[60] hidden bg-black/80 flex items-center justify-center p-4">
    <div class="bg-background rounded-lg shadow-lg w-full max-w-2xl border border-border max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-border flex justify-between items-center">
            <h3 id="title-produk" class="font-semibold text-lg">Tambah Menu</h3>
            <button type="button" onclick="closeModal('modal-produk')" class="text-muted-foreground hover:text-foreground">✕</button>
        </div>
        <form id="form-produk" method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf 
            <input type="hidden" name="_method" id="method-produk" value="POST">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium mb-2 block">Kedai</label>
                    <select id="input_kedai_produk" name="id_kedai" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                        <option value="">-- Pilih Kedai --</option>
                        @foreach($kedais as $kedai)
                            <option value="{{ $kedai->id }}">{{ $kedai->nama_kedai }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium mb-2 block">Kategori</label>
                    <select id="input_kategori_produk" name="id_kategori" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Nama Menu</label>
                <input type="text" id="input_nama_produk" name="nama_produk" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Deskripsi</label>
                <textarea id="input_deskripsi_produk" name="deskripsi" required rows="3" class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Harga</label>
                <input type="number" id="input_harga_produk" name="harga" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium mb-2 block">Gambar (Opsional)</label>
                <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:border-0 file:bg-muted file:px-4 file:py-1 cursor-pointer">
            </div>
            <button type="submit" class="w-full bg-primary text-primary-foreground h-10 rounded-md text-sm font-medium mt-4">Simpan</button>
        </form>
    </div>
</div>

<script>
    // 1. Script Pindah Tab & Memori LocalStorage
    function switchTab(event, tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => { 
            el.classList.remove('bg-background', 'text-foreground', 'shadow-sm', 'active-tab'); 
            el.classList.add('hover:text-foreground'); 
        });
        document.getElementById(tabId).classList.remove('hidden');
        
        let targetBtn = event ? event.currentTarget : document.querySelector(`button[onclick*="${tabId}"]`);
        if(targetBtn) { 
            targetBtn.classList.remove('hover:text-foreground'); 
            targetBtn.classList.add('bg-background', 'text-foreground', 'shadow-sm', 'active-tab'); 
        }
        localStorage.setItem('activeAdminTab', tabId);
    }
    
    document.addEventListener("DOMContentLoaded", () => {
        let savedTab = localStorage.getItem('activeAdminTab') || 'tab-kategori';
        switchTab(null, savedTab);
    });

    // 2. Fungsi Modal General
    function openModal(modalId) { 
        document.getElementById(modalId).classList.remove('hidden'); 
    }
    
    function closeModal(modalId) { 
        document.getElementById(modalId).classList.add('hidden'); 
        
        // Reset form ke mode POST (Tambah Data) tiap modal ditutup
        if(modalId === 'modal-kategori') { 
            document.getElementById('method-kategori').value = 'POST'; 
            document.getElementById('form-kategori').action = '{{ url("admin/kategori") }}'; 
            document.getElementById('form-kategori').reset(); 
            document.getElementById('title-kategori').innerText = 'Tambah Kategori'; 
        }
        if(modalId === 'modal-kedai') { 
            document.getElementById('method-kedai').value = 'POST'; 
            document.getElementById('form-kedai').action = '{{ url("admin/kedai") }}'; 
            document.getElementById('form-kedai').reset(); 
            document.getElementById('title-kedai').innerText = 'Tambah Kedai'; 
        }
        if(modalId === 'modal-produk') { 
            document.getElementById('method-produk').value = 'POST'; 
            document.getElementById('form-produk').action = '{{ url("admin/produk") }}'; 
            document.getElementById('form-produk').reset(); 
            document.getElementById('title-produk').innerText = 'Tambah Menu'; 
        }
    }

    // 3. Fungsi Edit Data (Mengambil data dari atribut HTML data-*)
    function editKategori(btn) {
        document.getElementById('title-kategori').innerText = 'Edit Kategori';
        document.getElementById('method-kategori').value = 'PUT';
        document.getElementById('form-kategori').action = `{{ url('admin/kategori') }}/${btn.dataset.id}`;
        
        document.getElementById('input_nama_kategori').value = btn.dataset.nama;
        document.getElementById('input_deskripsi_kategori').value = btn.dataset.deskripsi;
        
        openModal('modal-kategori');
    }

    function editKedai(btn) {
        document.getElementById('title-kedai').innerText = 'Edit Kedai';
        document.getElementById('method-kedai').value = 'PUT';
        document.getElementById('form-kedai').action = `{{ url('admin/kedai') }}/${btn.dataset.id}`;
        
        document.getElementById('input_nama_kedai').value = btn.dataset.nama;
        document.getElementById('input_alamat_kedai').value = btn.dataset.alamat;
        document.getElementById('input_deskripsi_kedai').value = btn.dataset.deskripsi;
        document.getElementById('input_map_kedai').value = btn.dataset.map;
        
        openModal('modal-kedai');
    }

    function editProduk(btn) {
        document.getElementById('title-produk').innerText = 'Edit Menu';
        document.getElementById('method-produk').value = 'PUT';
        document.getElementById('form-produk').action = `{{ url('admin/produk') }}/${btn.dataset.id}`;
        
        document.getElementById('input_kedai_produk').value = btn.dataset.kedai;
        document.getElementById('input_kategori_produk').value = btn.dataset.kategori;
        document.getElementById('input_nama_produk').value = btn.dataset.nama;
        document.getElementById('input_deskripsi_produk').value = btn.dataset.deskripsi;
        document.getElementById('input_harga_produk').value = btn.dataset.harga;
        
        openModal('modal-produk');
    }
</script>
@endsection