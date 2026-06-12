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
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('kedai.index') }}" class="inline-flex items-center justify-center rounded-md font-medium bg-primary text-primary-foreground hover:bg-primary/90 text-lg px-8 py-6 shadow-lg hover:shadow-xl transition-all">
          Jelajahi Kedai <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
        </a>
        <a href="{{ route('produk.index') }}" class="inline-flex items-center justify-center rounded-md font-medium border-2 border-input bg-background text-foreground hover:bg-accent hover:text-accent-foreground text-lg px-8 py-6 shadow-lg hover:shadow-xl transition-all">
          Lihat Menu Kopi
        </a>
      </div>
    </div>
  </section>

  <section class="container mx-auto px-4 py-20">
    <div class="text-center mb-12">
      <h2 class="font-serif text-4xl md:text-5xl font-bold text-foreground mb-4">Kopi Pilihan Kami</h2>
      <p class="text-lg text-muted-foreground max-w-2xl mx-auto">Setiap cangkir punya cerita. Temukan favoritmu di sini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="rounded-xl border bg-card text-card-foreground shadow group overflow-hidden hover:shadow-xl transition-all duration-300 border-2 hover:border-primary">
        <div class="aspect-square overflow-hidden">
          <img src="{{ asset('assets/americano.jpg') }}" alt="Americano" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-6">
          <h3 class="font-serif text-2xl font-semibold mb-2 text-foreground">Americano</h3>
          <p class="text-muted-foreground">Rasa klasik yang kuat, cocok untuk pecinta kopi hitam.</p>
        </div>
      </div>
      <div class="rounded-xl border bg-card text-card-foreground shadow group overflow-hidden hover:shadow-xl transition-all duration-300 border-2 hover:border-primary">
        <div class="aspect-square overflow-hidden">
          <img src="{{ asset('assets/latte.jpg') }}" alt="Latte" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-6">
          <h3 class="font-serif text-2xl font-semibold mb-2 text-foreground">Latte</h3>
          <p class="text-muted-foreground">Perpaduan lembut antara espresso dan susu hangat.</p>
        </div>
      </div>
      <div class="rounded-xl border bg-card text-card-foreground shadow group overflow-hidden hover:shadow-xl transition-all duration-300 border-2 hover:border-primary">
        <div class="aspect-square overflow-hidden">
          <img src="{{ asset('assets/cappuccino.jpg') }}" alt="Cappuccino" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-6">
          <h3 class="font-serif text-2xl font-semibold mb-2 text-foreground">Cappuccino</h3>
          <p class="text-muted-foreground">Kopi susu dengan busa tebal yang creamy.</p>
        </div>
      </div>
      <div class="rounded-xl border bg-card text-card-foreground shadow group overflow-hidden hover:shadow-xl transition-all duration-300 border-2 hover:border-primary">
        <div class="aspect-square overflow-hidden">
          <img src="{{ asset('assets/robusta.jpg') }}" alt="Robusta Bengkulu" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        </div>
        <div class="p-6">
          <h3 class="font-serif text-2xl font-semibold mb-2 text-foreground">Robusta Bengkulu</h3>
          <p class="text-muted-foreground">Cita rasa khas Bengkulu, pekat dan berkarakter.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-primary text-primary-foreground py-20">
    <div class="container mx-auto px-4 text-center">
      <h2 class="font-serif text-4xl md:text-5xl font-bold mb-6">Siap Untuk Ngopi?</h2>
      <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">Temukan kedai kopi favorit kamu dan rasakan kehangatan di setiap cangkir.</p>
      <a href="{{ route('kedai.index') }}" class="inline-flex items-center justify-center rounded-md font-medium bg-secondary text-secondary-foreground hover:bg-secondary/80 text-lg px-8 py-6 shadow-lg hover:shadow-xl">
        Cari Kedai Terdekat
      </a>
    </div>
  </section>
</div>
@endsection