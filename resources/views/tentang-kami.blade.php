@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="min-h-screen py-20">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h1 class="font-serif text-5xl md:text-6xl font-bold text-foreground mb-6">
        Tentang Kami
      </h1>
      <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
        Cerita di Balik Setiap Cangkir Kopi
      </p>
    </div>

    <div class="max-w-5xl mx-auto">
      <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12" 
           style="background-image: url('{{ asset('assets/about-bg.jpg') }}'); background-size: cover; background-position: center;">
        
        <div class="absolute inset-0 bg-gradient-to-b from-background/90 via-background/80 to-background/90"></div>
        
        <div class="relative p-8 md:p-16">
          <div class="bg-card/90 backdrop-blur-sm rounded-2xl p-8 md:p-12 border-2 border-primary/20 shadow-xl">
            <p class="text-xl md:text-2xl leading-relaxed text-foreground mb-6">
              Kopi Kito lahir dari kecintaan kami pada kopi lokal Bengkulu. Kami percaya setiap seduhan punya cerita — dari kebun, barista, hingga meja pelanggan.
            </p>
            <p class="text-xl md:text-2xl leading-relaxed text-foreground">
              Kami ingin membawa rasa lokal ke pengalaman global, memperkenalkan keunikan robusta Bengkulu kepada dunia sambil tetap menjaga kehangatan dan keakraban yang menjadi ciri khas kami.
            </p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-8 bg-card rounded-2xl border-2 border-border shadow-lg hover:shadow-xl transition-shadow">
          <div class="text-5xl font-serif font-bold text-primary mb-4">100%</div>
          <div class="text-lg font-medium text-foreground mb-2">Biji Kopi Lokal</div>
          <div class="text-muted-foreground">Langsung dari petani Bengkulu</div>
        </div>

        <div class="text-center p-8 bg-card rounded-2xl border-2 border-border shadow-lg hover:shadow-xl transition-shadow">
          <div class="text-5xl font-serif font-bold text-primary mb-4">10+</div>
          <div class="text-lg font-medium text-foreground mb-2">Kedai Mitra</div>
          <div class="text-muted-foreground">Tersebar di seluruh Bengkulu</div>
        </div>

        <div class="text-center p-8 bg-card rounded-2xl border-2 border-border shadow-lg hover:shadow-xl transition-shadow">
          <div class="text-5xl font-serif font-bold text-primary mb-4">5+</div>
          <div class="text-lg font-medium text-foreground mb-2">Tahun Pengalaman</div>
          <div class="text-muted-foreground">Melayani pecinta kopi</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection