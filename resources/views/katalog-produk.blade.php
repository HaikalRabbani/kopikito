@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-muted/30 pt-24 pb-20">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="text-center mb-16 animate-fade-in-up">
            <h1 class="font-serif text-4xl md:text-5xl font-bold text-foreground mb-4">Kategori Kopi</h1>
            <div class="w-20 h-1 bg-primary mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto leading-relaxed">
                Jelajahi berbagai macam jenis dan kategori kopi. Klik pada kategori untuk menemukan kedai-kedai terbaik di Kota Bengkulu yang menyajikannya.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($kategoris as $kat)
            <a href="{{ route('kedai.index', ['kategori' => $kat->id]) }}" class="group flex flex-col rounded-2xl border border-border bg-card text-card-foreground shadow-sm hover:shadow-lg hover:border-primary/50 transition-all duration-300 overflow-hidden cursor-pointer h-full animate-fade-in-up" style="animation-delay: {{ $loop->iteration * 0.1 }}s;">
                
                <div class="p-8 pb-6 flex-grow flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-6 text-primary group-hover:scale-110 group-hover:bg-primary group-hover:text-primary-foreground transition-all duration-300 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 8h1a4 4 0 1 1 0 8h-1"/>
                            <path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/>
                            <line x1="9" x2="9" y1="2" y2="4"/>
                            <line x1="13" x2="13" y1="2" y2="4"/>
                            <line x1="5" x2="5" y1="2" y2="4"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-bold mb-3 group-hover:text-primary transition-colors">{{ $kat->nama_kategori }}</h3>
                    <p class="text-sm text-muted-foreground line-clamp-3 leading-relaxed">
                        {{ $kat->deskripsi ?? 'Jelajahi berbagai kedai yang menyajikan varian ' . $kat->nama_kategori . ' terbaik untuk menemani harimu.' }}
                    </p>
                </div>

                <div class="bg-muted/50 p-4 border-t border-border mt-auto flex justify-center items-center text-primary font-medium text-sm group-hover:bg-primary/5 transition-colors">
                    Lihat Kedai 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 transform group-hover:translate-x-1 transition-transform">
                        <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 border-2 border-dashed border-border rounded-2xl bg-background/50">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground mb-4 opacity-50"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p class="text-lg text-muted-foreground font-medium">Belum ada kategori kopi yang tersedia.</p>
                <p class="text-sm text-muted-foreground mt-1">Silakan tambahkan kategori melalui halaman Admin.</p>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection