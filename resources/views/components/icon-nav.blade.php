<!-- Añadimos: fixed top-0 w-full z-50 transition-transform duration-300 e ID -->
<header id="smart-nav" class="bg-zin-50 top-0 w-full transition-transform duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Izquierda: Botón Regresar -->
            <div class="flex items-center">
                <a href="/"
                    class="group hover:bg-zinc-100 rounded-full p-1.5 px-4 flex items-center text-zinc-500 hover:text-[#3bc569] transition-all duration-200 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 transition-transform group-hover:-translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    <span class="ml-2 text-sm font-semibold tracking-wide">Inicio</span>
                </a>
            </div>

            <!-- Derecha: Acciones -->
            <div class="flex items-center space-x-5">
                <!-- Historial -->
                <a href="#"
                    class="text-zinc-500 hover:text-[#3bc569] transition-colors duration-200 p-1.5 hover:bg-zinc-100 rounded-full"
                    title="Historial">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                    </svg>
                </a>
                <div class="relative flex items-center gap-3" x-data="{ open: false }">
                    <!-- Menú / Opciones -->
                    <button @click="open = !open" type="button"
                        class="text-zinc-500 hover:text-[#3bc569] transition-colors cursor-pointer duration-200 p-1.5 rounded-full hover:bg-zinc-100"
                        title="Menú">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    {{-- Menú Desplegable (Dropdown) --}}
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 top-8 z-50 my-4 text-base list-none bg-white shadow-md min-w-[160px]"
                        style="display: none;">
                        <a href="{{ route('flashcards.mis') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border border-gray-200">Mis
                            flashcards</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- IMPORTANTE: Añade este div para empujar el contenido hacia abajo, ya que el header ahora es fixed -->
<div class="h-8"></div>
