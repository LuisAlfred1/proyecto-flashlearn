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
        {{-- Aquí si el usuario ya se autentico se debe mostrar su avatar y su nombre --}}
        @if (auth()->check())
            <div class="relative flex items-center gap-3" x-data="{ open: false }">
                {{-- Nombre del usuario (Opcional ocultar en móvil) --}}
                <span class="hidden sm:block text-sm font-medium text-white">
                    {{ auth()->user()->name }}
                </span>

                {{-- Botón del Avatar --}}
                <button @click="open = !open" type="button"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-green-300 overflow-hidden">
                    <span class="sr-only">Abrir menú de usuario</span>
                    <img class="w-9 h-9 object-cover"
                        src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                        alt="Avatar de {{ auth()->user()->name }}">
                </button>

                {{-- Menú Desplegable (Dropdown) --}}
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 top-10 z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-xl min-w-[160px]"
                    style="display: none;">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">{{ auth()->user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate">{{ auth()->user()->email }}</span>
                    </div>
                    <ul class="py-2">
                        <li>
                            {{-- Formulario para Logout seguro --}}
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @else
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="text-sm font-medium text-white hover:text-green-100 transition-colors">
                    Iniciar sesión
                </a>
            </div>
        @endif

    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white/40 px-4 py-3 space-y-1">
        <div class="pt-2 pb-1 flex flex-col gap-2">
            <a href="{{ route('login') }}"
                class="block rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Iniciar sesión
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
