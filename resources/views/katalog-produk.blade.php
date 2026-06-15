@extends('layouts.app')

@section('title', 'Kategori & Menu Kopi')

@section('content')
<div class="min-h-screen py-20">
  <div class="container mx-auto px-4">
    
    <div class="text-center mb-16">
      <h1 class="font-serif text-5xl md:text-6xl font-bold text-foreground mb-6">
        Katalog Menu Kopi
      </h1>
      <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
        Dari yang klasik sampai yang kekinian, setiap seduhan punya cerita dan karakter unik.
        Pilih yang sesuai dengan seleramu dari berbagai kedai mitra kami.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      
      {{-- Mengecek apakah ada data produk di database --}}
      @forelse ($produks as $item)
        <div class="rounded-xl border bg-card text-card-foreground shadow group overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 hover:border-primary h-full flex flex-col">
          
          <div class="aspect-square overflow-hidden bg-muted">
            {{-- Kalau admin upload gambar, tampilkan gambar dari database. Kalau kosong, pakai default (americano.jpg) --}}
            <img
              src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/americano.jpg') }}"
              alt="{{ $item->nama_produk }}"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            />
          </div>
          
          <div class="p-6 flex flex-col flex-grow">
            <h3 class="font-serif text-3xl font-semibold mb-2 text-foreground">
              {{ $item->nama_produk }}
            </h3>
            
            <div class="mb-4">
              <span class="text-xl text-primary font-bold">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
              </span>
              <span class="text-sm text-muted-foreground ml-2 font-medium">
                di {{ $item->kedai->nama_kedai ?? 'Kedai Tidak Diketahui' }}
              </span>
            </div>
            
            <p class="text-muted-foreground leading-relaxed flex-grow">
              {{ $item->deskripsi ?? 'Belum ada deskripsi untuk produk ini.' }}
            </p>

            @if($item->jenis_kopi)
            <div class="mt-4 pt-4 border-t border-border">
              <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-secondary text-secondary-foreground">
                {{ $item->jenis_kopi }}
              </span>
            </div>
            @endif

          </div>
        </div>
      @empty
        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
          <p class="text-xl text-muted-foreground">Belum ada menu kopi yang ditambahkan.</p>
        </div>
      @endforelse

    </div>
  </div>
</div>
@endsection