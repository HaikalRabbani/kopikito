@extends('layouts.app')

@section('content')
<div class="min-h-screen">
  <section class="relative h-[80vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/hero-coffee.jpg') }}');">
      <div class="absolute inset-0 bg-gradient-to-b from-background/80 via-background/50 to-background"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 text-center">
      <h1 class="font-serif text-5xl md:text-7xl font-bold text-foreground mb-6 animate-fade-in">
        Nikmati Cerita di Setiap Seduhan
      </h1>
      <p class="text-xl md:text-2xl text-muted-foreground mb-8 max-w-3xl mx-auto">
        Dari aroma robusta Bengkulu sampai rasa manis latte kekinian — semua ada di Kopi Kito.
      </p>
      
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full">
        <a href="{{ route('kedai.index') }}" class="w-full sm:w-[220px] inline-flex h-12 items-center justify-center rounded-md font-medium bg-primary text-primary-foreground hover:bg-primary/90 px-8 shadow-lg hover:shadow-xl transition-all">
          Jelajahi Kedai
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
        <a href="{{ route('produk.index') }}" class="w-full sm:w-[220px] inline-flex h-12 items-center justify-center rounded-md font-medium border-2 border-input bg-background text-foreground hover:bg-accent hover:text-accent-foreground px-8 shadow-lg hover:shadow-xl transition-all">
          Lihat Kategori Kedai
        </a>
      </div>
      
    </div>
  </section>

  <section class="container mx-auto px-4 py-20">
    <div class="text-center mb-12">
      <h2 class="font-serif text-4xl md:text-5xl font-bold text-foreground mb-4">Kopi Pilihan</h2>
      <p class="text-lg text-muted-foreground max-w-2xl mx-auto">Temukan kedai dari kategori pilihanmu di sini.</p>
    </div>

    <!-- ================= CARD KATEGORI DINAMIS ================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
      @forelse($kategoris as $kat)
      <!-- Link dikasih parameter ?kategori=id biar otomatis filter di halaman Daftar Kedai -->
      <a href="{{ route('kedai.index', ['kategori' => $kat->id]) }}" class="group block rounded-xl border border-border bg-card text-card-foreground shadow-sm p-6 hover:shadow-md hover:border-primary/50 transition-all duration-300 text-center cursor-pointer">
          <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-primary group-hover:scale-110 group-hover:bg-primary group-hover:text-primary-foreground transition-all duration-300">
              <!-- Icon Biji Kopi -->
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><line x1="9" x2="9" y1="2" y2="4"/><line x1="13" x2="13" y1="2" y2="4"/><line x1="5" x2="5" y1="2" y2="4"/></svg>
          </div>
          <h3 class="font-serif text-lg font-bold mb-2 group-hover:text-primary transition-colors">{{ $kat->nama_kategori }}</h3>
          <p class="text-sm text-muted-foreground line-clamp-2">{{ $kat->deskripsi }}</p>
      </a>
      @empty
      <div class="col-span-full text-center py-12 border border-dashed rounded-xl bg-muted/50 text-muted-foreground">
          Belum ada kategori yang tersedia.
      </div>
      @endforelse
    </div>

    <div class="text-center mt-12">
      <a href="{{ route('produk.index') }}" class="inline-flex h-11 items-center justify-center rounded-md font-medium border-2 border-input bg-background text-foreground hover:bg-accent hover:text-accent-foreground px-8 shadow-sm transition-all">
        Lihat Semua Kategori 
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
      </a>
    </div>
  </section>

  <section class="bg-primary text-primary-foreground py-20">
    <div class="container mx-auto px-4 text-center">
      <h2 class="font-serif text-4xl md:text-5xl font-bold mb-6">Siap Untuk Ngopi?</h2>
      <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">Temukan kedai kopi favorit kamu dan rasakan kehangatan di setiap cangkir.</p>
      <a href="{{ route('kedai.index') }}" class="inline-flex h-12 items-center justify-center rounded-md font-medium bg-secondary text-secondary-foreground hover:bg-secondary/80 px-8 shadow-lg hover:shadow-xl transition-colors">
        Cari Kedai Terdekat
      </a>
    </div>
  </section>
</div>
@endsection