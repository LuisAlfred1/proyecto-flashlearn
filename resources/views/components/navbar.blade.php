{{-- ===================== NAVBAR ===================== --}}
<header class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/90 backdrop-blur-md">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <div
                class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-900 text-white transition-transform duration-200 group-hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-lg font-bold tracking-tight font-display">
                FlashLearn
            </span>
        </a>

        {{-- Nav Links (desktop) --}}
        <ul class="hidden md:flex items-center gap-1">
            <li>
                <a href="{{ url('/') }}"
                    class="rounded-lg px-4 py-2 text-sm font-medium transition-colors duration-150
                            {{ request()->is('/') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900' }}">
                    Inicio
                </a>
            </li>
            <li>
                <a href="#"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-zinc-500 transition-colors duration-150 hover:bg-zinc-100 hover:text-zinc-900">
                    Acerca de
                </a>
            </li>
            <li>
                <a href="#"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-zinc-500 transition-colors duration-150 hover:bg-zinc-100 hover:text-zinc-900">
                    Servicios
                </a>
            </li>
            <li>
                <a href="#"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-zinc-500 transition-colors duration-150 hover:bg-zinc-100 hover:text-zinc-900">
                    Contacto
                </a>
            </li>
        </ul>

        {{-- CTA --}}
        <div class="hidden md:flex items-center gap-3">
            <a href="#" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
                Ingresar
            </a>
            <a href="#"
                class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white shadow-sm
                        transition-all duration-200 hover:bg-zinc-700 hover:shadow-md active:scale-95">
                Empezar
            </a>
        </div>

        {{-- Mobile menu button --}}
        <button id="mobile-menu-btn"
            class="flex md:hidden items-center justify-center h-9 w-9 rounded-lg border border-zinc-200
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
    <div id="mobile-menu" class="hidden md:hidden border-t border-zinc-100 bg-white px-4 py-3 space-y-1">
        <a href="{{ url('/') }}"
            class="block rounded-lg px-4 py-2.5 text-sm font-medium
                    {{ request()->is('/') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
            Inicio
        </a>
        <a href="#"
            class="block rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900">
            Acerca de
        </a>
        <a href="#"
            class="block rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900">
            Servicios
        </a>
        <a href="#"
            class="block rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900">
            Contacto
        </a>
        <div class="pt-2 pb-1 border-t border-zinc-100 flex flex-col gap-2">
            <a href="#" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-600 hover:bg-zinc-50">
                Ingresar
            </a>
            <a href="#"
                class="block rounded-lg bg-zinc-900 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-zinc-700">
                Empezar
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

@stack('scripts')
