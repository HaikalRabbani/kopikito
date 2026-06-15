@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-muted/30 pt-24 pb-20">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="flex flex-col items-center text-center gap-6 mb-12 animate-fade-in-up">
            <div class="flex flex-col items-center">
                <h1 class="font-serif text-4xl md:text-5xl font-bold text-foreground mb-4">Direktori Kedai Kopi</h1>
                <div class="w-20 h-1 bg-primary rounded-full mb-4"></div>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                    Temukan tempat nongkrong, nugas, atau sekadar menikmati secangkir kopi terbaik di Bengkulu.
                </p>
            </div>

            <form action="{{ route('kedai.index') }}" method="GET" class="w-full md:w-auto flex items-center justify-center gap-2 bg-background p-2 rounded-lg border border-border shadow-sm">
                <div class="relative w-full md:w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-muted-foreground"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    <select name="kategori" class="w-full h-10 pl-9 pr-4 text-sm rounded-md border-none bg-transparent focus:ring-0 cursor-pointer appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="h-10 px-4 bg-primary text-primary-foreground text-sm font-medium rounded-md hover:bg-primary/90 transition-colors">Filter</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            @forelse($kedais as $shop)
            <a href="{{ route('kedai.show', $shop->id) }}" class="group flex flex-col rounded-2xl border border-border bg-card text-card-foreground shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden bg-white animate-fade-in-up hover:-translate-y-1">
                
                <div class="aspect-[16/10] w-full bg-muted relative overflow-hidden">
                    @if($shop->gambar)
                        <img src="{{ asset('storage/' . $shop->gambar) }}" alt="{{ $shop->nama_kedai }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="flex flex-col items-center justify-center w-full h-full text-muted-foreground opacity-50 bg-muted/50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-2"><path d="M3 21h18"/><path d="M19 21v-4"/><path d="M19 17a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v4"/><path d="M21 7.333 12 3 3 7.333"/><path d="M5 21v-8.5"/></svg>
                            <span class="text-sm font-medium">Foto Belum Tersedia</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5">
                        <h3 class="font-serif text-3xl font-bold text-white mb-2">{{ $shop->nama_kedai }}</h3>
                        <div class="flex items-center text-white/80 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span class="truncate">{{ $shop->alamat }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex flex-wrap gap-2 mb-4">
                        @forelse($shop->kategoris as $kat)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                                {{ $kat->nama_kategori }}
                            </span>
                        @empty
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">Belum ada kategori</span>
                        @endforelse
                    </div>

                    <p class="text-sm leading-relaxed mb-6 flex-grow text-muted-foreground line-clamp-2">
                        {{ $shop->deskripsi }}
                    </p>

                    <div class="pt-4 border-t border-border flex items-center justify-between text-primary font-medium text-sm group-hover:text-primary/80 transition-colors">
                        <span>Lihat Menu & Detail</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 border-2 border-dashed border-border rounded-2xl bg-background/50">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground mb-4 opacity-50"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <p class="text-lg text-muted-foreground font-medium">Yah, kedainya belum ketemu.</p>
                <p class="text-sm text-muted-foreground mt-1">Coba pilih kategori lain atau reset filter pencarianmu.</p>
                <a href="{{ route('kedai.index') }}" class="mt-4 text-primary text-sm font-medium hover:underline">Reset Filter</a>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection