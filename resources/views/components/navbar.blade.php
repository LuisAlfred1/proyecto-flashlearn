{{-- ===================== NAVBAR ===================== --}}
<header class="fixed top-0 z-50 w-full transition-all duration-300">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <span class="text-lg text-white font-bold tracking-tight font-display">
                FlashLearn
            </span>
        </a>


        {{-- CTA --}}
        <div class="hidden md:flex items-center gap-3">
            <a href="#" class="text-sm font-medium text-zinc-100 hover:text-zinc-900 transition-colors">
                Pruebalo ahora!
            </a>
        </div>

        {{-- Mobile menu button --}}
        <button id="mobile-menu-btn"
            class="flex md:hidden items-center justify-center h-9 w-9 rounded-lg
                        text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 transition-colors"
            aria-label="Abrir menú">
            <svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white/40 px-4 py-3 space-y-1">
        <div class="pt-2 pb-1 flex flex-col gap-2">
            <a href="#" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Pruebalo ahora!
            </a>
        </div>
    </div>
</header>
{{-- =================== FIN NAVBAR =================== --}}

{{-- Mobile menu toggle script --}}
<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const iconMenu = document.getElementById('icon-menu');
    const iconClose = document.getElementById('icon-close');

    btn.addEventListener('click', () => {
        const isOpen = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden', isOpen);
        iconMenu.classList.toggle('hidden', !isOpen);
        iconClose.classList.toggle('hidden', isOpen);
    });
</script>

<script>
    const header = document.querySelector('header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            // Con gradiente al hacer scroll
            header.style.background = 'linear-gradient(90deg, #0e76b3 0%, #3bc569 100%)';
            header.classList.add('shadow-md');

            document.querySelectorAll('nav a').forEach(a => {
                a.classList.remove('text-zinc-100');
                a.classList.add('text-white');
            });
        } else {
            // Transparente arriba
            header.style.background = '';
            header.classList.remove('shadow-md');

            document.querySelectorAll('nav a').forEach(a => {
                a.classList.remove('text-white');
                a.classList.add('text-zinc-100');
            });
        }
    });
</script>

@stack('scripts')
