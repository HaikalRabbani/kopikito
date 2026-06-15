@extends('layouts.app')

@section('content')
<div class="min-h-screen py-20 bg-background text-foreground">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="mb-6 flex flex-col items-start gap-4">
            <nav class="flex text-sm text-muted-foreground" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('kedai.index') }}" class="hover:text-foreground hover:underline transition-colors">Daftar Kedai</a>
                    </li>
                    <li><div class="flex items-center"><span class="mx-2">/</span></div></li>
                    <li aria-current="page">
                        <span class="font-medium text-foreground">{{ $kedai->nama_kedai }}</span>
                    </li>
                </ol>
            </nav>

            <a href="{{ route('kedai.index') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Kembali ke Daftar Kedai
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="aspect-[4/3] overflow-hidden rounded-xl bg-muted border border-border">
                @if($kedai->gambar)
                    <img src="{{ asset('storage/' . $kedai->gambar) }}" alt="{{ $kedai->nama_kedai }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-muted-foreground/50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                        <span class="text-sm">Foto belum tersedia</span>
                    </div>
                @endif
            </div>
            
            <div class="flex flex-col justify-center space-y-4">
                <div class="flex flex-wrap gap-2">
                    @foreach($kedai->kategoris as $kat)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">
                            {{ $kat->nama_kategori }}
                        </span>
                    @endforeach
                </div>

                <h1 class="font-serif text-4xl md:text-5xl font-bold text-foreground">
                    {{ $kedai->nama_kedai }}
                </h1>
                <div class="flex items-start gap-2 text-muted-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mt-1 flex-shrink-0 text-primary"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <p class="text-lg">{{ $kedai->alamat }}</p>
                </div>
                <p class="text-lg leading-relaxed whitespace-pre-line text-muted-foreground border-t border-border pt-4">
                    {{ $kedai->deskripsi ?: 'Deskripsi kedai belum ditambahkan.' }}
                </p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="font-serif text-3xl font-semibold mb-6">Lokasi</h2>
            <div class="aspect-video rounded-xl overflow-hidden border-2 border-border bg-muted flex items-center justify-center relative [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:absolute [&>iframe]:inset-0">
                @if($kedai->map_url)
                    {!! $kedai->map_url !!}
                @else
                    <div class="text-muted-foreground text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-2 opacity-50"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                        <p>Peta lokasi belum ditambahkan.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-12">
            <h2 class="font-serif text-3xl font-semibold mb-6 flex items-center gap-2">
                Menu Kopi <span class="text-sm font-medium bg-primary/10 text-primary px-3 py-1 rounded-full mb-1">{{ $menus->count() }}</span>
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($menus as $menu)
                <div onclick="openMenuModal('{{ addslashes($menu->nama_produk) }}', '{{ addslashes($menu->deskripsi) }}', '{{ number_format($menu->harga, 0, ',', '.') }}', '{{ $menu->gambar ? asset('storage/' . $menu->gambar) : '' }}', '{{ $menu->kategori->nama_kategori ?? 'Kopi' }}')" 
                     class="group cursor-pointer rounded-xl border-2 border-border bg-card text-card-foreground shadow-sm hover:shadow-xl transition-all duration-300 hover:border-primary overflow-hidden flex flex-col">
                    
                    <div class="aspect-square overflow-hidden bg-muted relative">
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_produk }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-muted-foreground/30"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg></div>
                        @endif
                        <span class="absolute top-3 right-3 bg-white/90 text-primary text-xs font-bold px-2 py-1 rounded-md shadow-sm">{{ $menu->kategori->nama_kategori ?? 'Kopi' }}</span>
                    </div>
                    
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="font-serif text-xl font-semibold mb-2 group-hover:text-primary transition-colors">{{ $menu->nama_produk }}</h3>
                        <p class="text-sm text-muted-foreground mb-3 line-clamp-2 flex-grow">
                            {{ $menu->deskripsi }}
                        </p>
                        <p class="text-lg font-bold text-primary border-t border-border pt-3 mt-auto">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-16 flex flex-col items-center justify-center text-center border-2 border-dashed border-border rounded-xl bg-muted/30">
                    <p class="text-lg font-medium text-foreground mb-1">Belum Ada Menu</p>
                    <p class="text-sm text-muted-foreground">Kedai ini belum mendaftarkan menu kopi mereka.</p>
                </div>
                @endforelse
            </div>
        </div>

        @if($relatedKedais->count() > 0)
        <div>
            <h2 class="font-serif text-3xl font-semibold mb-6 border-t border-border pt-12">
                Kedai Serupa
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedKedais as $rk)
                <a href="{{ route('kedai.show', $rk->id) }}" class="group cursor-pointer rounded-xl border border-border bg-card shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="aspect-square overflow-hidden bg-muted">
                        @if($rk->gambar)
                            <img src="{{ asset('storage/' . $rk->gambar) }}" alt="{{ $rk->nama_kedai }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-muted-foreground/30"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M19 21v-4"/><path d="M19 17a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v4"/><path d="M21 7.333 12 3 3 7.333"/><path d="M5 21v-8.5"/></svg></div>
                        @endif
                    </div>
                    <div class="p-3 text-center border-t border-border">
                        <h3 class="font-semibold text-sm mb-1 group-hover:text-primary transition-colors line-clamp-1">{{ $rk->nama_kedai }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<div id="menu-modal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4 transition-opacity">
    <div class="bg-background rounded-xl shadow-2xl w-full max-w-3xl border border-border overflow-hidden flex flex-col md:flex-row relative">
        
        <button type="button" onclick="closeMenuModal()" class="absolute top-4 right-4 z-10 bg-black/50 text-white rounded-full p-1 hover:bg-black transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>

        <div class="w-full md:w-1/2 aspect-square md:aspect-auto bg-muted">
            <img id="modal-img" src="" alt="Menu Image" class="w-full h-full object-cover hidden">
            <div id="modal-no-img" class="w-full h-full flex flex-col items-center justify-center text-muted-foreground/50 bg-muted/50 hidden">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                <span class="text-sm mt-2">Foto tidak tersedia</span>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-center bg-card">
            <span id="modal-category" class="inline-block px-2.5 py-1 rounded-md text-xs font-semibold bg-primary/10 text-primary w-fit mb-3">Kategori</span>
            
            <h2 id="modal-title" class="font-serif text-2xl md:text-3xl font-bold mb-4 text-foreground">Nama Menu</h2>
            
            <p id="modal-desc" class="text-muted-foreground leading-relaxed mb-6 flex-grow">
                Deskripsi menu kopi.
            </p>
            
            <div class="pt-4 border-t border-border mt-auto">
                <p class="text-sm text-muted-foreground mb-1 font-medium">Harga</p>
                <p id="modal-price" class="text-3xl font-bold text-primary">Rp 0</p>
            </div>
        </div>
    </div>
</div>

<script>
    function openMenuModal(nama, deskripsi, harga, image_url, kategori) {
        // Isi teks
        document.getElementById('modal-title').innerText = nama;
        document.getElementById('modal-desc').innerText = deskripsi;
        document.getElementById('modal-price').innerText = 'Rp ' + harga;
        document.getElementById('modal-category').innerText = kategori;

        // Atur gambar
        const imgEl = document.getElementById('modal-img');
        const noImgEl = document.getElementById('modal-no-img');
        
        if(image_url) {
            imgEl.src = image_url;
            imgEl.classList.remove('hidden');
            noImgEl.classList.add('hidden');
        } else {
            imgEl.src = '';
            imgEl.classList.add('hidden');
            noImgEl.classList.remove('hidden');
        }

        // Tampilkan Modal
        document.getElementById('menu-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Kunci scroll halaman
    }

    function closeMenuModal() {
        document.getElementById('menu-modal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Buka kunci scroll halaman
    }

    // Tutup modal kalau klik area hitam di luar modal
    document.getElementById('menu-modal').addEventListener('click', function(e) {
        if(e.target === this) { closeMenuModal(); }
    });
</script>

@endsection