{{-- Usamos el layout secundario sin el navbar, ya que tendrá su propia barra de navegación --}}
@extends('layouts.app-clean')

@section('content')
    <div class="py-8 md:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Toast de notificaciones (inicialmente oculto) --}}
        <div id="toast"
            class="hidden fixed top-4 right-4 border-2 border-green-500 bg-green-400 text-white px-4 py-2 rounded-md shadow-lg">
            Guardando flashcards...
        </div>

        {{-- Modal para notificar al usuario que debe iniciar sesión --}}
        <div id="login-modal"
            class="hidden fixed inset-0 bg-black/60 bg-opacity-50 flex items-center justify-center p-4 z-60">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-md">
                <h2 class="text-xl font-bold text-zinc-900 mb-4">Debes iniciar sesión</h2>
                <p class="text-zinc-600 mb-6">Para guardar tus flashcards, por favor inicia sesión.</p>
                <div class="flex justify-end gap-4">
                    <button id="cancelar-btn"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancelar</button>
                    <button id="login-btn" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Iniciar
                        sesión</button>
                </div>
            </div>
        </div>

        {{-- Titulo de pagina --}}
        <div class="text-center mb-8 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-zinc-900">Genera tus Flashcards</h1>
            <p class="text-sm text-zinc-500 mt-2">Elige un tema e idioma y la IA hará el resto</p>
        </div>

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
        <div class=" mt-6">
            {{-- Header de cards — sticky tipo GitHub --}}
            <header id="cards-header"
                class="hidden sticky top-0 z-40 bg-white/60 backdrop-blur-md border-b border-zinc-100
           justify-between items-center flex-wrap gap-3 px-4 py-3 mb-6
           transition-all duration-300">

                {{-- Izquierda: bandera + tema + idioma --}}
                <div class="flex items-center gap-3">
                    <span id="cards-flag" class="fi fis rounded-md shadow-sm"
                        style="width:1.75rem; height:1.75rem; font-size:1.75rem;"></span>
                    <div class="flex flex-col">
                        <span id="cards-tema" class="text-sm text-zinc-900"></span>
                        <span id="cards-idioma" class="text-xs text-zinc-400"></span>
                    </div>
                </div>

                {{-- Derecha: botones con iconos --}}
                <div class="flex items-center gap-2">

                    {{-- Guardar --}}

                    {{-- Después se hará una validación, si el usuario se autentica, entonces los flashcards serán guardados
                        y si no, entonces se le redirigirá a la página de login para que pueda acceder a esta función. Por eso el href apunta a login, pero solo se activará si no está autenticado.
                        si el usuario no quiere autenticarse, entonces se redigira a la página de inicio sin guardar, pero si se autentica, entonces se guardará y se redirigirá a la página de flashcards.
                    --}}
                    <button id="btn-guardar"
                        class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-medium
                        text-white transition-all duration-200 hover:opacity-90 active:scale-95 cursor-pointer bg-green-600 hover:bg-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Guardar
                    </button>

                    {{-- Limpiar --}}
                    <button id="btn-limpiar"
                        class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-medium
                   bg-zinc-100 text-zinc-600 hover:bg-red-50 hover:text-red-500
                   transition-all duration-200 active:scale-95 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Limpiar
                    </button>

                </div>
            </header>

            {{-- Ejemplo de cards estáticas (eliminar después) 
            <div class="">
                @for ($i = 1; $i <= 5; $i++)
                    <x-card palabra="Palabra {{ $i }}" traduccion="Traducción {{ $i }}"
                        ejemplo="Ejemplo de uso para la palabra {{ $i }}" />
                @endfor
            </div>
            --}}

            <div id="flashcards-grid"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3 md:gap-4 py-4 sm:px-6">
                {{-- Aquí se renderizarán las flashcards --}}
            </div>

            {{-- Paginación FUERA del grid --}}
            <div id="pagination" class="hidden flex items-center justify-center gap-4 py-6">
                <button id="btn-prev"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium
                           bg-zinc-100 text-zinc-600 hover:bg-zinc-200 transition-all
                           active:scale-95 cursor-pointer disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                    Anterior
                </button>

                <span id="page-info" class="text-sm font-semibold text-zinc-500 min-w-[48px] text-center">
                    1 / 2
                </span>

                <button id="btn-next"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium bg-[#0e76b3] hover:bg-[#0c679c]
                           text-white transition-all active:scale-95 cursor-pointer disabled:cursor-not-allowed">
                    Siguiente
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

        </div>
        @push('scripts')
            <script>
                // Variable global para almacenar las flashcards generadas
                let currentFlashcards = [];

                // Función para guardar flashcards en localStorage
                function savePendingFlashcards() {
                    const tema = document.getElementById('cards-tema').textContent;
                    const language = document.getElementById('cards-idioma').textContent;

                    if (!tema || !language || currentFlashcards.length === 0) {
                        return false;
                    }

                    localStorage.setItem('pendingFlashcards', JSON.stringify({
                        tema: tema,
                        language: language,
                        flashcards: currentFlashcards,
                        timestamp: Date.now()
                    }));

                    return true;
                }

                // Función para guardar flashcards pendientes (después de autenticarse)
                function savePendingFlashcardsToServer() {
                    const pending = localStorage.getItem('pendingFlashcards');

                    if (!pending) {
                        return;
                    }

                    const data = JSON.parse(pending);
                    const btn = document.getElementById('btn-guardar');

                    // Actualizar UI con datos pendientes
                    currentFlashcards = data.flashcards;
                    document.getElementById('cards-tema').textContent = data.tema;
                    document.getElementById('cards-idioma').textContent = data.language;

                    // Mostrar header si no está visible
                    const cardsHeader = document.getElementById('cards-header');
                    if (cardsHeader && cardsHeader.classList.contains('hidden')) {
                        cardsHeader.classList.remove('hidden');
                        cardsHeader.classList.add('flex');
                    }

                    // Mostrar notificación
                    //En vez de usar alert, se puede usar una notificación más elegante. como un toast en parte superior centrado que diga "Guardando flashcards..." y que desaparezca después de 3 segundos.
                    // alert('Guardando flashcards...');
                    const toast = document.getElementById('toast');
                    toast.classList.remove('hidden');

                    // Ocultar notificación después de 3 segundos
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 3000);

                    // Cambiar botón a estado de carga
                    btn.disabled = true;
                    btn.textContent = 'Guardando...';

                    // Hacer fetch para guardar
                    fetch('{{ route('flashcards.save') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                topic: data.tema,
                                language: data.language,
                                flashcards: data.flashcards
                            })
                        })
                        .then(res => res.json())
                        .then(result => {
                            if (result.ok) {
                                // Limpiar localStorage
                                localStorage.removeItem('pendingFlashcards');

                                // Redirigir a mis flashcards
                                window.location.href = '{{ route('flashcards.mis') }}';
                            } else {
                                alert('Error al guardar: ' + result.message);
                                btn.disabled = false;
                                btn.textContent = 'Guardar';
                            }
                        })
                        .catch(() => {
                            alert('Error de conexión al guardar.');
                            btn.disabled = false;
                            btn.textContent = 'Guardar';
                        });
                }

                // Al cargar la página, verificar si hay flashcards pendientes
                document.addEventListener('DOMContentLoaded', function() {
                    @auth
                    // Si está autenticado y hay flashcards pendientes, guardarlas
                    setTimeout(savePendingFlashcardsToServer, 500);
                @endauth
                });

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
                    <div class="col-span-full flex flex-col items-center justify-center py-16 gap-4">
                        <div class="relative w-12 h-12">
                            <div class="absolute inset-0 rounded-full border-4 border-zinc-200"></div>
                            <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0e76b3] border-r-[#3bc569] animate-spin"></div>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-medium text-zinc-600">Generando flashcards...</p>
                            <p class="text-xs text-zinc-400 mt-1">La IA está trabajando en ello</p>
                        </div>
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

                                // Guardar las flashcards en la variable global
                                currentFlashcards = data.flashcards;

                                const flagMap = {
                                    'Inglés': 'fi-us',
                                    'Francés': 'fi-fr',
                                    'Alemán': 'fi-de',
                                    'Italiano': 'fi-it',
                                    'Portugués': 'fi-pt',
                                    'Japonés': 'fi-jp',
                                    'Chino': 'fi-cn',
                                };

                                // Mostrar y actualizar el header
                                const cardsHeader = document.getElementById('cards-header');
                                const cardsFlag = document.getElementById('cards-flag');
                                const cardsTema = document.getElementById('cards-tema');
                                const cardsIdioma = document.getElementById('cards-idioma');

                                cardsHeader.classList.remove('hidden');
                                cardsHeader.classList.add('flex');

                                // Actualizar bandera
                                cardsFlag.className =
                                    `fi ${flagMap[data.language] ?? 'fi-un'} fis rounded-md shadow-sm`;

                                // Actualizar textos
                                cardsTema.textContent = data.tema;
                                cardsIdioma.textContent = data.language;

                                // Renderizar las cards con paginación
                                const flashcards = data.flashcards;
                                const cardsPerPage = 5;
                                let currentPage = 1;
                                const totalPages = Math.ceil(flashcards.length / cardsPerPage);

                                function renderPage(page) {
                                    const start = (page - 1) * cardsPerPage;
                                    const end = start + cardsPerPage;
                                    const pageCards = flashcards.slice(start, end);

                                    grid.innerHTML = pageCards.map(card => `
                                <div class="bg-white border border-[#3bc569] rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col gap-3">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-zinc-900">${card.word}</h3>
                                        <button
                                            onclick="speakText('${card.word}', '${data.language}')"
                                            class="text-zinc-400 hover:text-[#0e76b3] transition-colors hover:scale-110 cursor-pointer p-1 rounded-lg hover:bg-blue-50"
                                            title="Escuchar pronunciación">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-sm text-zinc-700">${card.translation}</p>
                                    <div class="border-t border-zinc-100 pt-3 mt-auto flex justify-between items-start gap-2">
                                        <p class="text-xs text-zinc-600 italic">"${card.example}"</p>
                                        <button
                                            onclick="speakText('${card.example}', '${data.language}')"
                                            class="text-zinc-300 hover:text-[#3bc569] transition-colors hover:scale-110 cursor-pointer flex-shrink-0 p-1 rounded-lg hover:bg-green-50"
                                            title="Escuchar ejemplo">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            `).join('');

                                    // Actualizar controles de paginación
                                    document.getElementById('page-info').textContent = `${page} / ${totalPages}`;
                                    document.getElementById('btn-prev').disabled = page === 1;
                                    document.getElementById('btn-next').disabled = page === totalPages;
                                    document.getElementById('btn-prev').classList.toggle('opacity-40', page === 1);
                                    document.getElementById('btn-next').classList.toggle('opacity-40', page ===
                                        totalPages);
                                }

                                // Primera página
                                renderPage(currentPage);

                                // Mostrar controles
                                document.getElementById('pagination').classList.remove('hidden');

                                // Eventos de paginación
                                document.getElementById('btn-prev').onclick = () => {
                                    if (currentPage > 1) {
                                        currentPage--;
                                        renderPage(currentPage);
                                    }
                                };
                                document.getElementById('btn-next').onclick = () => {
                                    if (currentPage < totalPages) {
                                        currentPage++;
                                        renderPage(currentPage);
                                    }
                                };

                                // Activar scroll listener del header
                                const cardsHeaderSticky = document.getElementById('cards-header');
                                cardsHeaderSticky.dataset.active = 'true';

                            } else {
                                //Aqui se puede valida el limite de uso de la IA
                                if (data.message ===
                                    "Has alcanzado el límite de uso gratuito. Por favor, espera 24 horas.") {
                                    grid.innerHTML = `
                                <div class="col-span-full flex flex-col items-center justify-center py-16 px-4">
                                    <div class="max-w-2xl w-full bg-white rounded-2xl p-4 text-center">
                                        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-amber-50 mb-6">
                                            <svg class="h-8 w-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-slate-800 mb-2">¡Límite diario alcanzado!</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            Has aprovechado todas tus consultas gratuitas por hoy. Por favor vuelve en <span class="font-bold text-amber-600">24 horas</span>.
                                        </p>
                                    </div>
                                </div>
                            `;
                                } else {
                                    grid.innerHTML = `
                                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-red-400">
                                            <p class="text-sm font-medium">Error: ${data.message}</p>
                                        </div>
                                    `;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            grid.innerHTML = `
                        <div class="col-span-full flex flex-col items-center justify-center py-16 text-red-400">
                            <p class="text-sm font-medium">Error de conexión. Intenta de nuevo.</p>
                        </div>
                    `;
                        })
                        .finally(() => {
                            // Reactiva el botón al terminar
                            btnGen.disabled = false;
                            btnGen.textContent = 'Generar Flashcards en ' + language;
                            btnGen.style.background = 'linear-gradient(90deg, #0e76b3 0%, #3bc569 100%)';
                        });
                });

                // Configurar listeners de idiomas FUERA del evento submit
                let flagsElements = document.querySelectorAll('.flag-btn');
                let inputIdioma = document.getElementById('idioma');
                let btnGenerarFlashcards = document.getElementById('btn-generar');

                flagsElements.forEach(btn => {
                    btn.addEventListener('click', () => {

                        // Quita selección anterior
                        flagsElements.forEach(b => {
                            b.classList.remove('border-[#0e76b3]', 'bg-blue-100');
                            b.querySelector('span.text-xs').classList.remove('text-[#0e76b3]');
                        });

                        // Marca el seleccionado
                        btn.classList.add('border-[#0e76b3]', 'bg-blue-100');
                        btn.querySelector('span.text-xs').classList.add('text-[#0e76b3]');

                        // Guarda el valor en el input hidden
                        inputIdioma.value = btn.dataset.idioma;

                        // Activa el botón
                        btnGenerarFlashcards.disabled = false;
                        btnGenerarFlashcards.textContent = 'Generar Flashcards en ' + btn.dataset.idioma;
                        btnGenerarFlashcards.style.background = 'linear-gradient(90deg, #0e76b3 0%, #3bc569 100%)';
                    });
                });

                // --- Web Speech API ---
                const langCodeMap = {
                    'Inglés': 'en-US',
                    'Francés': 'fr-FR',
                    'Alemán': 'de-DE',
                    'Italiano': 'it-IT',
                    'Portugués': 'pt-BR',
                    'Japonés': 'ja-JP',
                    'Chino': 'zh-CN',
                };

                function speakText(text, idioma) {
                    if (!window.speechSynthesis) {
                        alert('Tu navegador no soporta síntesis de voz.');
                        return;
                    }

                    // Cancela cualquier voz que esté sonando
                    window.speechSynthesis.cancel();

                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = langCodeMap[idioma] ?? 'en-US';
                    utterance.rate = 0.7; // velocidad (1 = normal, 0.9 = un poco más lento)
                    utterance.pitch = 1; // tono

                    window.speechSynthesis.speak(utterance);
                }

                // --- Lógica del botón Guardar ---
                document.getElementById('btn-guardar').addEventListener('click', function() {

                    @guest
                    // Si no está autenticado, guardar en localStorage y redirigir al login
                    if (savePendingFlashcards()) {

                        //En vez de usar un alert, se puede usar un modal que diga "Por favor, inicia sesión para guardar tus flashcards." con un botón que diga "Ir a Login" y otro que diga "Cancelar" (que simplemente cierre el modal). El modal se puede implementar con HTML/CSS y mostrarlo al hacer clic en guardar, en vez de usar alert.
                        //alert('Por favor, inicia sesión para guardar tus flashcards.');

                        document.getElementById('login-modal').classList.remove('hidden');
                        document.getElementById("login-btn").onclick = function() {
                            window.location.href = '{{ route('login') }}';
                        };
                        document.getElementById("cancelar-btn").onclick = function() {
                            document.getElementById('login-modal').classList.add('hidden');
                        };

                    }
                @endguest

                @auth
                // Si está autenticado, guarda la sesión
                const tema = document.getElementById('cards-tema').textContent;
                const language = document.getElementById('cards-idioma').textContent;

                if (!tema || !language) {
                    alert('Primero genera unas flashcards.');
                    return;
                }

                // Cambia el botón a estado de carga
                const btn = document.getElementById('btn-guardar'); btn.disabled = true; btn.textContent =
                'Guardando...';

                fetch('{{ route('flashcards.save') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        topic: tema,
                        language: language,
                        flashcards: currentFlashcards // ← el array de flashcards actual
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.ok) {
                        window.location.href = '{{ route('flashcards.mis') }}';
                        currentFlashcards = data
                            .flashcards; // Actualiza el array global con las flashcards guardadas.
                    } else {
                        alert('Error al guardar: ' + data.message);
                        btn.disabled = false;
                        btn.textContent = 'Guardar';
                    }
                })
                .catch(() => {
                    alert('Error de conexión al guardar.');
                    btn.disabled = false;
                    btn.textContent = 'Guardar';
                });
                @endauth
                });
            </script>
        @endpush
    </div>
@endsection
