@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="min-h-screen py-24 bg-background">
  <div class="container mx-auto px-4 max-w-5xl">
    
    <div class="text-center mb-20">
      <h1 class="font-serif text-5xl md:text-6xl font-bold text-foreground mb-6">
        Tentang Kopi Kito
      </h1>
      <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
        Inovasi Digital untuk Pengalaman Pemasaran Kopi Terbaik
      </p>
    </div>

    <div class="bg-card rounded-[3rem] p-10 md:p-16 lg:p-20 border border-border/50 shadow-2xl mb-24 relative overflow-hidden">
      
      <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>
      
      <div class="space-y-8 text-lg md:text-xl text-muted-foreground leading-relaxed text-center max-w-3xl mx-auto relative z-10">
        
        <p class="text-foreground font-medium text-2xl md:text-3xl font-serif leading-snug">
          "Menyajikan kemudahan bagi pelanggan dengan sentuhan pelayanan modern berbasis digital."
        </p>
        
        <div class="w-24 h-1 bg-primary/20 mx-auto rounded-full my-10"></div>
        
        <p>
          Sistem Informasi Pemasaran ini dikembangkan sebagai langkah inovasi kami di era digital. Tujuan utama platform berbasis web ini adalah memberikan kemudahan bagi pelanggan untuk mengakses informasi lengkap mengenai katalog menu, lokasi, serta berbagai pembaruan terbaru secara cepat dan praktis.
        </p>
        <p>
          Melalui sistem ini, kami berharap dapat memperluas jangkauan pemasaran, mendekatkan diri dengan para penikmat kopi, dan terus meningkatkan kualitas pelayanan kami kepada Anda.
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 max-w-5xl mx-auto">
      
      <div class="bg-card rounded-[2.5rem] p-10 lg:p-12 border border-border/50 shadow-xl hover:shadow-2xl text-center hover:border-primary/30 transition-all duration-300 hover:-translate-y-2 group">
        <div class="mx-auto w-24 h-24 bg-primary/5 rounded-[1.5rem] flex items-center justify-center mb-8 transform -rotate-3 transition-transform duration-300 group-hover:rotate-0">
          <i data-lucide="laptop" class="w-10 h-10 text-primary"></i>
        </div>
        <h3 class="font-serif text-2xl font-bold text-foreground mb-4">Akses Digital</h3>
        <p class="text-muted-foreground text-lg leading-relaxed">
          Informasi katalog dan pemasaran yang mudah diakses melalui perangkat apa pun, kapan saja.
        </p>
      </div>
      
      <div class="bg-card rounded-[2.5rem] p-10 lg:p-12 border border-border/50 shadow-xl hover:shadow-2xl text-center hover:border-primary/30 transition-all duration-300 hover:-translate-y-2 group">
        <div class="mx-auto w-24 h-24 bg-primary/5 rounded-[1.5rem] flex items-center justify-center mb-8 transform rotate-3 transition-transform duration-300 group-hover:rotate-0">
          <i data-lucide="users" class="w-10 h-10 text-primary"></i>
        </div>
        <h3 class="font-serif text-2xl font-bold text-foreground mb-4">Fokus Pelanggan</h3>
        <p class="text-muted-foreground text-lg leading-relaxed">
          Kemudahan, kenyamanan, dan kepuasan Anda dalam mencari informasi adalah prioritas utama kami.
        </p>
      </div>

    </div>

  </div>
</div>
@endsection