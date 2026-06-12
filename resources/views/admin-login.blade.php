@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4 bg-gradient-to-br from-background to-secondary">
  <div class="w-full max-w-md rounded-xl border bg-card text-card-foreground shadow-lg">
    <div class="flex flex-col space-y-1.5 p-6">
      <h3 class="text-3xl font-serif text-center font-semibold leading-none tracking-tight">
        Admin Login
      </h3>
    </div>
    <div class="p-6 pt-0">
      
      <!-- Menampilkan Error jika gagal login -->
      @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="text-sm font-medium mb-2 block">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@kopikito.com" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
        </div>
        <div>
          <label class="text-sm font-medium mb-2 block">Password</label>
          <input type="password" name="password" required placeholder="••••••••" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
        </div>
        <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full">
          Masuk
        </button>
      </form>
      
      <div class="mt-4 text-center text-sm">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-primary hover:underline">Daftar di sini</a>
      </div>
    </div>
  </div>
</div>
@endsection