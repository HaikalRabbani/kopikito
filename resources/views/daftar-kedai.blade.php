@extends('layouts.app')

@section('title', 'Daftar Kedai Kopi')

@section('content')
<div class="min-h-screen py-20">
  <div class="container mx-auto px-4">
    
    <div class="text-center mb-16">
      <h1 class="font-serif text-5xl md:text-6xl font-bold text-foreground mb-6">
        Daftar Kedai
      </h1>
      <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
        Temukan kedai kopi favorit di Bengkulu. Setiap tempat punya suasana dan cerita yang berbeda.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      
      @forelse ($kedai as $shop)
        <div class="rounded-xl border bg-card text-card-foreground shadow group overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 hover:border-primary h-full flex flex-col">
          
          <div class="aspect-video overflow-hidden bg-muted">
            <img
              src="{{ $shop->gambar ? asset('storage/' . $shop->gambar) : asset('assets/coffee-shop-1.jpg') }}"
              alt="{{ $shop->nama_kedai }}"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            />
          </div>
          
          <div class="p-6 flex flex-col flex-grow">
            <h3 class="font-serif text-3xl font-semibold mb-3 text-foreground">
              {{ $shop->nama_kedai }}
            </h3>
            
            <div class="flex items-start gap-2 mb-3">
              <i data-lucide="map-pin" class="w-5 h-5 text-primary flex-shrink-0 mt-1"></i>
              <p class="text-muted-foreground">{{ $shop->alamat }}</p>
            </div>
            
            @if($shop->kontak)
            <div class="flex items-center gap-2 mb-3">
              <i data-lucide="phone" class="w-4 h-4 text-primary"></i>
              <p class="text-sm font-medium text-foreground">{{ $shop->kontak }}</p>
            </div>
            @endif

            <p class="text-foreground mb-4 leading-relaxed flex-grow">
              {{ $shop->deskripsi ?? 'Belum ada deskripsi untuk kedai ini.' }}
            </p>
            
            @if($shop->map_url)
            <div class="aspect-video rounded-lg overflow-hidden border-2 border-border mt-auto">
              <iframe
                src="{{ $shop->map_url }}"
                width="100%"
                height="100%"
                style="border: 0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi {{ $shop->nama_kedai }}"
              ></iframe>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-1 lg:col-span-2 text-center py-12">
          <p class="text-xl text-muted-foreground">Belum ada data kedai yang ditambahkan.</p>
        </div>
      @endforelse

    </div>
  </div>
</div>
@endsection