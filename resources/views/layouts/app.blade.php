<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Kito — Seduhan Lokal, Rasa Global</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground antialiased min-h-screen flex flex-col">

    <nav class="sticky top-0 z-50 bg-background/95 backdrop-blur-sm border-b border-border shadow-sm">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex items-center justify-between h-20">
                
                <a href="{{ route('beranda') }}" class="flex items-center gap-2 group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-primary transition-transform group-hover:rotate-12">
                        <path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><line x1="9" x2="9" y1="2" y2="4"/><line x1="13" x2="13" y1="2" y2="4"/><line x1="5" x2="5" y1="2" y2="4"/>
                    </svg>
                    <span class="font-serif text-2xl font-bold text-primary">Kopi Kito</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('beranda') }}" class="font-medium transition-colors hover:text-primary {{ request()->routeIs('beranda') ? 'text-primary' : 'text-foreground' }}">
                        Beranda
                    </a>
                    <a href="{{ route('produk.index') }}" class="font-medium transition-colors hover:text-primary {{ request()->routeIs('produk.index') ? 'text-primary' : 'text-foreground' }}">
                        Kategori Kopi
                    </a>
                    <a href="{{ route('kedai.index') }}" class="font-medium transition-colors hover:text-primary {{ request()->routeIs('kedai.index') ? 'text-primary' : 'text-foreground' }}">
                        Daftar Kedai
                    </a>
                    <a href="{{ route('tentang') }}" class="font-medium transition-colors hover:text-primary {{ request()->routeIs('tentang') ? 'text-primary' : 'text-foreground' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('kontak') }}" class="font-medium transition-colors hover:text-primary {{ request()->routeIs('kontak') ? 'text-primary' : 'text-foreground' }}">
                        Hubungi Kami
                    </a>
                </div>

                <button id="mobile-menu-btn" class="md:hidden inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors hover:bg-accent hover:text-accent-foreground h-10 w-10">
                    <svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    <svg id="icon-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 hidden"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden py-4 border-t border-border">
                <a href="{{ route('beranda') }}" class="block py-3 font-medium transition-colors hover:text-primary {{ request()->routeIs('beranda') ? 'text-primary' : 'text-foreground' }}">Beranda</a>
                <a href="{{ route('produk.index') }}" class="block py-3 font-medium transition-colors hover:text-primary {{ request()->routeIs('produk.index') ? 'text-primary' : 'text-foreground' }}">Kategori Kopi</a>
                <a href="{{ route('kedai.index') }}" class="block py-3 font-medium transition-colors hover:text-primary {{ request()->routeIs('kedai.index') ? 'text-primary' : 'text-foreground' }}">Daftar Kedai</a>
                <a href="{{ route('tentang') }}" class="block py-3 font-medium transition-colors hover:text-primary {{ request()->routeIs('tentang') ? 'text-primary' : 'text-foreground' }}">Tentang Kami</a>
                <a href="{{ route('kontak') }}" class="block py-3 font-medium transition-colors hover:text-primary {{ request()->routeIs('kontak') ? 'text-primary' : 'text-foreground' }}">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-primary text-primary-foreground mt-20">
        <div class="container mx-auto px-4 py-12 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><line x1="9" x2="9" y1="2" y2="4"/><line x1="13" x2="13" y1="2" y2="4"/><line x1="5" x2="5" y1="2" y2="4"/></svg>
                        <span class="font-serif text-xl font-bold">Kopi Kito</span>
                    </div>
                    <p class="text-primary-foreground/80">
                        Seduhan Lokal, Rasa Global
                    </p>
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
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                        </a>
                        <a href="https://wa.me/" target="_blank" rel="noopener noreferrer" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M2.5 7.1c.1-1.4 1.2-2.6 2.7-2.7C8.6 4.1 12 4.1 15.4 4.3c1.5.1 2.6 1.3 2.7 2.8.2 1.6.2 3.2 0 4.8-.1 1.4-1.2 2.6-2.7 2.7-3.4.2-6.8.2-10.2 0-1.5-.1-2.6-1.3-2.7-2.8-.2-1.6-.2-3.2 0-4.8z"/><path d="m10 9 4 2-4 2v-4z"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="border-t border-primary-foreground/20 mt-8 pt-8 text-center">
                <p class="text-primary-foreground/80">© 2025 Kopi Kito — Seduhan Lokal, Rasa Global.</p>
                <a href="{{ Auth::check() ? route('admin.dashboard') : route('login') }}" class="text-primary-foreground/60 hover:text-primary-foreground/80 text-sm mt-2 inline-block transition-colors">
                    {{ Auth::check() ? 'Dashboard Admin' : 'Login Admin' }}
                </a>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconX = document.getElementById('icon-x');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconMenu.classList.toggle('hidden');
            iconX.classList.toggle('hidden');
        });
    </script>
</body>
</html>