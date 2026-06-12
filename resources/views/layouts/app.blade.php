<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Kito - @yield('title', 'Sistem Informasi Pemasaran')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background text-foreground font-sans flex flex-col min-h-screen">

    <nav x-data="{ isOpen: false }" class="sticky top-0 z-50 bg-background/95 backdrop-blur-sm border-b border-border shadow-sm">
      <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
          <a href="{{ route('beranda') }}" class="flex items-center gap-2 group">
            <i data-lucide="coffee" class="w-8 h-8 text-primary transition-transform group-hover:rotate-12"></i>
            <span class="font-serif text-2xl font-bold text-primary">Kopi Kito</span>
          </a>

          <div class="hidden md:flex items-center gap-8">
            <a href="{{ route('beranda') }}" class="font-medium transition-colors hover:text-primary text-primary">Beranda</a>
            <a href="{{ route('produk.index') }}" class="font-medium transition-colors hover:text-primary text-foreground">Kategori Kopi</a>
            <a href="{{ route('kedai.index') }}" class="font-medium transition-colors hover:text-primary text-foreground">Daftar Kedai</a>
            <a href="{{ route('kontak') }}" class="font-medium transition-colors hover:text-primary text-foreground">Hubungi Kami</a>
          </div>

          <button @click="isOpen = !isOpen" class="md:hidden p-2 text-foreground hover:bg-muted rounded-md">
            <i x-show="!isOpen" data-lucide="menu" class="w-6 h-6"></i>
            <i x-show="isOpen" data-lucide="x" class="w-6 h-6" x-cloak></i>
          </button>
        </div>

        <div x-show="isOpen" style="display: none;" class="md:hidden py-4 border-t border-border">
          <a href="{{ route('beranda') }}" class="block py-3 font-medium transition-colors hover:text-primary text-primary">Beranda</a>
          <a href="{{ route('produk.index') }}" class="block py-3 font-medium transition-colors hover:text-primary text-foreground">Kategori Kopi</a>
          <a href="{{ route('kedai.index') }}" class="block py-3 font-medium transition-colors hover:text-primary text-foreground">Daftar Kedai</a>
          <a href="{{ route('kontak') }}" class="block py-3 font-medium transition-colors hover:text-primary text-foreground">Hubungi Kami</a>
        </div>
      </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-primary text-primary-foreground mt-20">
      <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <div class="flex items-center gap-2 mb-4">
              <i data-lucide="coffee" class="w-6 h-6"></i>
              <span class="font-serif text-xl font-bold">Kopi Kito</span>
            </div>
            <p class="text-primary-foreground/80">Seduhan Lokal, Rasa Global</p>
          </div>

          <div>
            <h3 class="font-serif font-semibold mb-4">Tautan Cepat</h3>
            <div class="flex flex-col gap-2">
              <a href="{{ route('beranda') }}" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">Beranda</a>
              <a href="{{ route('produk.index') }}" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">Kategori Kopi</a>
              <a href="{{ route('kedai.index') }}" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">Daftar Kedai</a>
            </div>
          </div>

          <div>
            <h3 class="font-serif font-semibold mb-4">Ikuti Kami</h3>
            <div class="flex gap-4">
              <a href="#" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">
                <i data-lucide="instagram" class="w-6 h-6"></i>
              </a>
              <a href="#" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">
                <i data-lucide="youtube" class="w-6 h-6"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="border-t border-primary-foreground/20 mt-8 pt-8 text-center">
          <p class="text-primary-foreground/80">© 2026 Kopi Kito — Seduhan Lokal, Rasa Global.</p>
          <a href="{{ route('admin.kedai.index') }}" class="text-primary-foreground/60 hover:text-primary-foreground/80 text-sm mt-2 inline-block transition-colors">Admin Panel</a>
        </div>
      </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>