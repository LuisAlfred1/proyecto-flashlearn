{{-- Usamos el layout secundario sin el navbar, ya que tendrá su propia barra de navegación --}}
@extends('layouts.app-clean')

@section('content')
    <div class="py-8 md:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Titulo de pagina --}}
        <div class="text-center mb-8 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-zinc-900">Genera tus Flashcards</h1>
            <p class="text-sm text-zinc-500 mt-2">Elige un tema e idioma y la IA hará el resto</p>
        </div>

        {{-- ===== FORMULARIO ===== --}}
        {{-- ===== FORMULARIO ===== --}}
        <div class="p-2 md:p-2 mb-6 md:mb-8">
            <form id="flashcard-form" class="flex flex-col gap-6">
                @csrf

                {{-- Input oculto que guarda el idioma seleccionado --}}
                <input type="hidden" id="idioma" name="idioma" value="">

                {{-- Tema --}}
                <div class="flex-1">
                    <input type="text" id="tema" name="tema" placeholder="ej: Saludo de bienvenida"
                        value="{{ old('tema') }}"
                        class="w-full rounded-2xl border-2 border-green-700 px-5 py-4 text-sm text-zinc-900
                       placeholder:text-zinc-400 outline-none transition-all duration-200
                       focus:border-[#2f9952] shadow-md shadow-green-300
                       @error('tema') border-red-400 @enderror" />
                    @error('tema')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Selector de idioma con banderas --}}
                <div>
                    @error('idioma')
                        <p class="mb-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="flex flex-wrap gap-2 md:gap-8 justify-center" id="flag-selector">

                        {{-- Inglés --}}
                        <button type="button" data-idioma="Inglés"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-us fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Inglés</span>
                        </button>

                        {{-- Francés --}}
                        <button type="button" data-idioma="Francés"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-fr fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Francés</span>
                        </button>

                        {{-- Alemán --}}
                        <button type="button" data-idioma="Alemán"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-de fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Alemán</span>
                        </button>

                        {{-- Italiano --}}
                        <button type="button" data-idioma="Italiano"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-it fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Italiano</span>
                        </button>

                        {{-- Portugués --}}
                        <button type="button" data-idioma="Portugués"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-pt fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Portugués</span>
                        </button>

                        {{-- Japonés --}}
                        <button type="button" data-idioma="Japonés"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-jp fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Japonés</span>
                        </button>

                        {{-- Chino --}}
                        <button type="button" data-idioma="Chino"
                            class="flag-btn flex flex-col items-center gap-1.5 p-2 rounded-xl border-transparent
                           hover:border-[#0e76b3] hover:bg-blue-100 transition-all duration-200 cursor-pointer group">
                            <span class="fi fi-cn fis rounded-md shadow-sm"
                                style="font-size: 2.5rem; width: 3rem; height: 3rem;"></span>
                            <span class="text-xs text-zinc-500 group-hover:text-[#0e76b3] font-medium">Chino</span>
                        </button>

                    </div>
                </div>

                {{-- Botón generar --}}
                <button type="submit" id="btn-generar" disabled
                    class="w-full py-3 px-6 rounded-xl font-semibold text-white text-sm
                   transition-all duration-300 active:scale-[0.98] cursor-pointer
                   bg-zinc-300 disabled:cursor-not-allowed"
                    style="">
                    Selecciona un idioma para continuar
                </button>

            </form>
        </div>

        {{-- ===== AREA DE CARDS ===== --}}
        <div>

            {{-- Grid de cards --}}
            <div id="flashcards-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-4">
                {{-- Aquí se llamó al componente card.blade.php, para ver una vista previa de lo que serán las tarjetas, esto se deberá implementar con datos dinámicos a traves del backend con la API --}}
                {{-- Las cards se renderizan dinámicamente desde el JS --}}
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            // --- Lógica del Formulario ---
            document.getElementById('flashcard-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const tema = document.getElementById('tema').value;
                const language = document.getElementById('idioma').value;
                const grid = document.getElementById('flashcards-grid');
                const btnGen = document.getElementById('btn-generar');

                // Estado de carga
                btnGen.disabled = true;
                btnGen.textContent = 'Generando...';
                btnGen.style.background = 'linear-gradient(90deg, #0e76b3 0%, #3bc569 100%)';
                grid.innerHTML = `
                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-zinc-400">
                        <svg class="animate-spin h-8 w-8 mb-3 text-[#3bc569]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                        <p class="text-sm">Generando flashcards...</p>
                    </div>
                `;

                fetch('{{ route('flashcards.generate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            tema,
                            language
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.ok) {
                            console.log('¡Generado con éxito!', data);

                            // Actualizar el header con tema e idioma
                            document.querySelector('header .text-zinc-500').innerHTML =
                                `Tema: <strong>${data.tema}</strong> | Idioma: <strong>${data.language}</strong>`;

                            // Renderizar las cards
                            grid.innerHTML = data.flashcards.map(card => `
                                <div class="bg-white border border-zinc-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col gap-3">
                                    <span class="text-xs font-semibold uppercase tracking-widest" style="color: #0e76b3;">${data.language}</span>
                                    <h3 class="text-2xl font-bold text-zinc-900">${card.palabra}</h3>
                                    <p class="text-sm text-zinc-500">${card.traduccion}</p>
                                    <div class="border-t border-zinc-100 pt-3 mt-auto">
                                        <p class="text-xs text-zinc-400 italic">"${card.ejemplo}"</p>
                                    </div>
                                </div>
                            `).join('');
                        } else {
                            grid.innerHTML = `
                                <div class="col-span-full flex flex-col items-center justify-center py-16 text-red-400">
                                    <p class="text-sm font-medium">Error: ${data.message}</p>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        grid.innerHTML = `
                            <div class="col-span-full flex flex-col items-center justify-center py-16 text-red-400">
                                <p class="text-sm font-medium">Error de conexión. Intenta de nuevo.</p>
                            </div>
                        `;
                    }).finally(() => {
                        // Reactiva el botón al terminar
                        btnGen.disabled = false;
                        btnGen.textContent = 'Generar Flashcards en ' + language;
                        btnGen.style.background = 'linear-gradient(90deg, #0e76b3 0%, #3bc569 100%)';
                    });
            });

            // --- Lógica del Smart Navbar ---
            let lastScrollTop = 0;
            const nav = document.getElementById('smart-nav');
            const threshold = 10; // Sensibilidad: píxeles mínimos para reaccionar

            window.addEventListener('scroll', function() {
                let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

                // 1. Evitar valores negativos
                if (currentScroll < 0) currentScroll = 0;

                // 2. Solo actuar si el movimiento supera el threshold (sensibilidad)
                if (Math.abs(lastScrollTop - currentScroll) <= threshold) return;

                // 3. Lógica de ocultar/mostrar
                if (currentScroll > lastScrollTop && currentScroll > 100) {
                    // Bajando: ocultar
                    nav.classList.add('-translate-y-full');
                } else {
                    // Subiendo: mostrar
                    nav.classList.remove('-translate-y-full');
                }

                lastScrollTop = currentScroll;
            }, false);

            const flags = document.querySelectorAll('.flag-btn');
            const input = document.getElementById('idioma');
            const btnGen = document.getElementById('btn-generar');

            flags.forEach(btn => {
                btn.addEventListener('click', () => {

                    // Quita selección anterior
                    flags.forEach(b => {
                        b.classList.remove('border-[#0e76b3]', 'bg-blue-100');
                        b.querySelector('span.text-xs').classList.remove('text-[#0e76b3]');
                    });

                    // Marca el seleccionado
                    btn.classList.add('border-[#0e76b3]', 'bg-blue-100');
                    btn.querySelector('span.text-xs').classList.add('text-[#0e76b3]');

                    // Guarda el valor en el input hidden
                    input.value = btn.dataset.idioma;

                    // Activa el botón
                    btnGen.disabled = false;
                    btnGen.textContent = 'Generar Flashcards en ' + btn.dataset.idioma;
                    btnGen.style.background = 'linear-gradient(90deg, #0e76b3 0%, #3bc569 100%)';
                });
            });
        </script>
    @endpush
@endsection
