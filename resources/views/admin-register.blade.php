@extends('layouts.app')

@section('title', 'Daftar Admin')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4 bg-gradient-to-br from-background to-secondary">
  <div class="w-full max-w-md rounded-xl border bg-card text-card-foreground shadow-lg">
    <div class="flex flex-col space-y-1.5 p-6 text-center">
      <h3 class="text-3xl font-serif font-semibold leading-none tracking-tight">
        Daftar Admin
      </h3>
      <p class="text-sm text-muted-foreground mt-2">Buat akun admin baru untuk Kopi Kito</p>
    </div>
    <div class="p-6 pt-0">

      <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
          <label class="text-sm font-medium mb-2 block">Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Admin" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
          @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="text-sm font-medium mb-2 block">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@kopikito.com" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
          @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="text-sm font-medium mb-2 block">Password</label>
          <input type="password" name="password" required placeholder="Minimal 6 karakter" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
          @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="text-sm font-medium mb-2 block">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" required placeholder="Masukkan ulang password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
        </div>

        <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full mt-2">
          Daftar
        </button>
      </form>
      
      <div class="mt-4 text-center text-sm">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-primary hover:underline">Login di sini</a>
      </div>
    </div>
  </div>
</div>
@endsection