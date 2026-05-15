{{-- resources/views/pages/mis-flashcards.blade.php --}}
@extends('layouts.app-flashcard')

@section('content')
    <div class="py-2 max-w-7xl mx-auto px-10 sm:px-12 lg:px-16">

        {{-- Modal si desea eliminar la sesión --}}
        <div id="delete-modal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-sm text-center">
                <h3 class="text-lg font-bold text-zinc-900 mb-4">¿Eliminar esta sesión?</h3>
                <p class="text-sm text-zinc-500 mb-6">Esta acción no se puede deshacer. Se eliminarán las 10 tarjetas de esta
                    sesión.</p>
                <div class="flex justify-center gap-4">
                    <button id="confirm-delete"
                        class="px-4 py-2 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-all">
                        Sí, eliminar
                    </button>
                    <button id="cancel-delete"
                        class="px-4 py-2 rounded-xl bg-zinc-100 text-zinc-700 hover:bg-zinc-200 transition-all">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>

        {{-- ===== ESTADO: NO AUTENTICADO ===== --}}
        @guest
            <div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">

                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6"
                    style="background: linear-gradient(135deg, #0e76b320, #3bc56920)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#0e76b3" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>

                <h1 class="text-2xl font-bold text-zinc-900 mb-2">Inicia sesión para ver tus flashcards</h1>
                <p class="text-sm text-zinc-500 max-w-sm mb-8">
                    Necesitas una cuenta para guardar y acceder a tus flashcards generadas.
                    Tus tarjetas estarán disponibles en cualquier momento.
                </p>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold
                               text-white transition-all hover:opacity-90 active:scale-95"
                        style="background: linear-gradient(90deg, #0e76b3 0%, #3bc569 100%);">
                        Iniciar sesión con Google
                    </a>
                    <a href="/flashcards"
                        class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold
                               bg-zinc-100 text-zinc-700 hover:bg-zinc-200 transition-all active:scale-95">
                        Generar flashcards sin cuenta
                    </a>
                </div>

            </div>
        @endguest

        {{-- ===== ESTADO: AUTENTICADO ===== --}}
        @auth
            {{-- Header de la página --}}
            <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-zinc-900">Mis flashcards</h1>
                    <p class="text-sm text-zinc-500 mt-1">Hola, <strong>{{ auth()->user()->name }}</strong> — aquí están tus
                        sesiones guardadas</p>
                </div>
            </div>

            {{-- Lista de sesiones --}}
            <div id="sessions-container">

                {{-- Estado de carga --}}
                <div id="loading-state" class="flex flex-col items-center justify-center py-20 gap-4">
                    <div class="relative w-10 h-10">
                        <div class="absolute inset-0 rounded-full border-4 border-zinc-200"></div>
                        <div
                            class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0e76b3] border-r-[#3bc569] animate-spin">
                        </div>
                    </div>
                    <p class="text-sm text-zinc-400">Cargando tus flashcards...</p>
                </div>

                {{-- Estado vacío (se muestra si no hay sesiones) --}}
                <div id="empty-state" class="hidden flex-col items-center justify-center py-20 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-zinc-100 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7 text-zinc-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2m14 0V9a2 2 0 0 0-2-2M5 11V9a2 2 0 0 1 2-2m0 0V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-zinc-600">Aún no tienes flashcards guardadas</p>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Genera tu primera sesión y guárdala para verla aquí</p>
                    <a href="/flashcards"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-[#0e76b3] hover:bg-[#0b6497] text-white transition-all hover:opacity-90">
                        Generar mis primeras flashcards
                    </a>
                </div>

                {{-- Lista de sesiones (se llena con JS) --}}
                <div id="sessions-list" class="hidden flex flex-col gap-4">
                </div>

                {{-- Detalle de una sesión (se muestra al hacer clic) --}}
                <div id="session-detail" class="hidden">

                    {{-- Botón volver --}}
                    <button id="btn-volver"
                        class="flex items-center gap-2 text-sm text-zinc-500 hover:text-zinc-800
                               transition-colors mb-6 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                        Volver a mis sesiones
                    </button>

                    {{-- Info de la sesión --}}
                    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <span id="detail-flag" class="fi fis rounded-md shadow-sm"
                                style="width:2rem; height:2rem; font-size:2rem;"></span>
                            <div>
                                <h2 id="detail-topic" class="text-xl font-bold text-zinc-900"></h2>
                                <span id="detail-language" class="text-xs text-zinc-400"></span>
                            </div>
                        </div>
                        <button id="btn-delete-session"
                            class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-medium
                                   bg-red-50 text-red-500 hover:bg-red-100 transition-all cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Eliminar sesión
                        </button>
                    </div>

                    {{-- Grid de flashcards de la sesión --}}
                    <div id="detail-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3">
                    </div>

                </div>

            </div>
        @endauth

    </div>

    @auth
        @push('scripts')
            <script>
                const flagMap = {
                    'Inglés': 'fi-us',
                    'Francés': 'fi-fr',
                    'Alemán': 'fi-de',
                    'Italiano': 'fi-it',
                    'Portugués': 'fi-pt',
                    'Japonés': 'fi-jp',
                    'Chino': 'fi-cn',
                };

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
                    if (!window.speechSynthesis) return;
                    window.speechSynthesis.cancel();
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = langCodeMap[idioma] ?? 'en-US';
                    utterance.rate = 0.9;
                    window.speechSynthesis.speak(utterance);
                }

                // --- Cargar sesiones al entrar ---
                async function loadSessions() {
                    try {
                        const res = await fetch('{{ route('flashcards.sessions') }}', {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();

                        document.getElementById('loading-state').classList.add('hidden');

                        if (!data.ok || data.sessions.length === 0) {
                            document.getElementById('empty-state').classList.remove('hidden');
                            document.getElementById('empty-state').classList.add('flex');
                            return;
                        }

                        renderSessions(data.sessions);

                    } catch (e) {
                        document.getElementById('loading-state').innerHTML =
                            `<p class="text-sm text-red-400">Error al cargar tus sesiones.</p>`;
                    }
                }

                // --- Renderizar lista de sesiones ---
                function renderSessions(sessions) {
                    const list = document.getElementById('sessions-list');
                    list.classList.remove('hidden');
                    list.classList.add('flex');

                    list.innerHTML = sessions.map(session => `
                <div class="bg-white border border-zinc-100 rounded-2xl p-5 shadow-sm
                            hover:shadow-md transition-shadow flex items-center justify-between flex-wrap gap-3 cursor-pointer group"
                     onclick="loadSessionDetail(${session.id}, '${session.topic}', '${session.target_language}')">

                    <div class="flex items-center gap-4">
                        <span class="fi ${flagMap[session.target_language] ?? 'fi-un'} fis rounded-lg shadow-sm"
                              style="width:2.25rem; height:2.25rem; font-size:2.25rem; flex-shrink:0;"></span>
                        <div>
                            <p class="text-sm font-semibold text-zinc-900 group-hover:text-[#0e76b3] transition-colors">
                                ${session.topic}
                            </p>
                            <p class="text-xs text-zinc-400">${session.target_language} · ${session.flashcards_count} tarjetas · ${session.created_at}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-xs text-zinc-400 group-hover:text-[#0e76b3] transition-colors flex items-center gap-1">
                            Ver tarjetas
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                            </svg>
                        </span>
                    </div>

                </div>
            `).join('');
                }

                // --- Cargar detalle de una sesión ---
                async function loadSessionDetail(sessionId, topic, language) {
                    document.getElementById('sessions-list').classList.add('hidden');
                    document.getElementById('sessions-list').classList.remove('flex');
                    document.getElementById('session-detail').classList.remove('hidden');

                    // Actualizar info del header
                    document.getElementById('detail-topic').textContent = topic;
                    document.getElementById('detail-language').textContent = language;
                    document.getElementById('detail-flag').className =
                        `fi ${flagMap[language] ?? 'fi-un'} fis rounded-md shadow-sm`;

                    // Guardar session id para el botón eliminar
                    document.getElementById('btn-delete-session').dataset.sessionId = sessionId;

                    // Cargar las tarjetas
                    const grid = document.getElementById('detail-grid');
                    grid.innerHTML = `
                <div class="col-span-full flex justify-center py-10">
                    <div class="relative w-10 h-10">
                        <div class="absolute inset-0 rounded-full border-4 border-zinc-200"></div>
                        <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0e76b3] border-r-[#3bc569] animate-spin"></div>
                    </div>
                </div>
            `;

                    try {
                        const res = await fetch(`/flashcards/my-sessions/${sessionId}`, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();

                        if (!data.ok) {
                            grid.innerHTML = `<p class="text-sm text-red-400 col-span-full">Error al cargar las tarjetas.</p>`;
                            return;
                        }

                        grid.innerHTML = data.flashcards.map(card => `
                    <div class="bg-white border border-[#3bc569] rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col gap-3">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-bold text-zinc-900">${card.original_word}</h3>
                            <button onclick="speakText('${card.original_word}', '${language}')"
                                class="text-zinc-400 hover:text-[#0e76b3] transition-colors cursor-pointer p-1 rounded-lg hover:bg-blue-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm text-zinc-700">${card.translated_word}</p>
                        <div class="border-t border-zinc-100 pt-3 mt-auto flex justify-between items-start gap-2">
                            <p class="text-xs text-zinc-600 italic">"${card.example_sentence}"</p>
                            <button onclick="speakText('${card.example_sentence}', '${language}')"
                                class="text-zinc-300 hover:text-[#3bc569] transition-colors cursor-pointer flex-shrink-0 p-1 rounded-lg hover:bg-green-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `).join('');

                    } catch (e) {
                        grid.innerHTML = `<p class="text-sm text-red-400 col-span-full">Error de conexión.</p>`;
                    }
                }

                // --- Volver a la lista ---
                document.getElementById('btn-volver').addEventListener('click', () => {
                    document.getElementById('session-detail').classList.add('hidden');
                    document.getElementById('sessions-list').classList.remove('hidden');
                    document.getElementById('sessions-list').classList.add('flex');
                });

                // --- Eventos del modal (globales) ---
                let currentSessionIdToDelete = null;

                // Cuando hace clic en eliminar sesión, muestra el modal
                document.getElementById('btn-delete-session').addEventListener('click', function() {
                    currentSessionIdToDelete = this.dataset.sessionId;
                    document.getElementById('delete-modal').classList.remove('hidden');
                });

                // Cuando confirma la eliminación
                document.getElementById('confirm-delete').addEventListener('click', async () => {
                    if (!currentSessionIdToDelete) return;

                    try {
                        const res = await fetch(`/flashcards/my-sessions/${currentSessionIdToDelete}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            }
                        });
                        const data = await res.json();

                        if (data.ok) {
                            // Cerrar el modal
                            document.getElementById('delete-modal').classList.add('hidden');

                            // Limpiar y recargar
                            document.getElementById('session-detail').classList.add('hidden');
                            document.getElementById('sessions-list').innerHTML = '';
                            document.getElementById('loading-state').classList.remove('hidden');
                            loadSessions();

                            currentSessionIdToDelete = null;
                        } else {
                            alert('Error al eliminar: ' + data.message);
                        }
                    } catch (e) {
                        alert('Error de conexión al eliminar la sesión.');
                    }
                });

                // Cuando cancela la eliminación
                document.getElementById('cancel-delete').addEventListener('click', () => {
                    document.getElementById('delete-modal').classList.add('hidden');
                    currentSessionIdToDelete = null;
                });

                // Cargar al iniciar
                loadSessions();
            </script>
        @endpush
    @endauth
@endsection
