@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="min-h-screen py-20 bg-background">
  <div class="container mx-auto px-4">
    
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="font-serif text-5xl md:text-6xl font-bold text-foreground mb-6">
        Hubungi Kami
      </h1>
      <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
        Ada pertanyaan atau saran? Kami senang mendengar dari kamu!
      </p>
    </div>

    <!-- Alert / Toast Sukses (Pengganti Sonner Toast) -->
    @if(session('success'))
      <div class="max-w-6xl mx-auto mb-8 p-4 bg-green-100/50 border border-green-500 text-green-700 rounded-lg flex items-center gap-3 animate-fade-in">
        <i data-lucide="check-circle" class="w-6 h-6"></i>
        <p class="font-medium">{{ session('success') }}</p>
      </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
      
      <!-- Kolom Kiri: Form -->
      <div>
        <div class="rounded-xl border-2 bg-card text-card-foreground shadow-sm">
          <div class="p-8">
            <h2 class="font-serif text-3xl font-semibold mb-6 text-foreground">
              Kirim Pesan
            </h2>
            
            <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
              @csrf <!-- Token wajib keamanan form di Laravel -->
              
              <div>
                <label for="nama" class="text-base font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                  Nama
                </label>
                <input
                  type="text"
                  id="nama"
                  name="nama"
                  required
                  placeholder="Nama kamu"
                  value="{{ old('nama') }}"
                  class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                />
                @error('nama') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label for="email" class="text-base font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                  Email
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  required
                  placeholder="email@example.com"
                  value="{{ old('email') }}"
                  class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                />
                @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <div>
                <label for="pesan" class="text-base font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                  Pesan
                </label>
                <textarea
                  id="pesan"
                  name="pesan"
                  required
                  placeholder="Tulis pesan kamu di sini..."
                  class="flex min-h-[150px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                >{{ old('pesan') }}</textarea>
                @error('pesan') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
              </div>

              <button
                type="submit"
                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-11 px-8 w-full"
              >
                Kirim Pesan
              </button>
            </form>

          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Info Kontak (Cards) -->
      <div class="space-y-6">
        
        <!-- Card Alamat -->
        <div class="rounded-xl border-2 bg-card text-card-foreground shadow-sm">
          <div class="p-8 flex items-start gap-4">
            <div class="bg-primary/10 p-3 rounded-lg">
              <i data-lucide="map-pin" class="w-6 h-6 text-primary"></i>
            </div>
            <div>
              <h3 class="font-serif text-xl font-semibold mb-2 text-foreground">Alamat</h3>
              <p class="text-muted-foreground">
                Jl. Korpri 12 No. 546<br />
                Bengkulu, Indonesia
              </p>
            </div>
          </div>
        </div>

        <!-- Card Email -->
        <div class="rounded-xl border-2 bg-card text-card-foreground shadow-sm">
          <div class="p-8 flex items-start gap-4">
            <div class="bg-primary/10 p-3 rounded-lg">
              <i data-lucide="mail" class="w-6 h-6 text-primary"></i>
            </div>
            <div>
              <h3 class="font-serif text-xl font-semibold mb-2 text-foreground">Email</h3>
              <p class="text-muted-foreground">info@kopikito.com</p>
            </div>
          </div>
        </div>

        <!-- Card Telepon -->
        <div class="rounded-xl border-2 bg-card text-card-foreground shadow-sm">
          <div class="p-8 flex items-start gap-4">
            <div class="bg-primary/10 p-3 rounded-lg">
              <i data-lucide="phone" class="w-6 h-6 text-primary"></i>
            </div>
            <div>
              <h3 class="font-serif text-xl font-semibold mb-2 text-foreground">Telepon</h3>
              <p class="text-muted-foreground">+62 895327052665</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
@endsection