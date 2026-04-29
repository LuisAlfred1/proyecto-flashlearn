{{-- resources/views/pages/flashcards.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Titulo de pagina --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-zinc-900">Genera tus Flashcards</h1>
            <p class="text-sm text-zinc-500 mt-2">Elige un tema e idioma y la IA hará el resto</p>
        </div>

        {{-- ===== FORMULARIO EN FILA ===== --}}
        <div class="bg-white rounded-2xl shadow border border-zinc-100 p-6 mb-8">
            <form onsubmit="alert('Se enviarán los datos al backend')" class="flex flex-col md:flex-row gap-4 items-end">
                @csrf

                {{-- Tema --}}
                <div class="flex-1">
                    <label for="tema" class="block text-sm font-medium text-zinc-700 mb-1.5">
                        Tema de estudio
                    </label>
                    <input type="text" id="tema" name="tema"
                        placeholder="Ej: Comida en un restaurante, Términos de programación..." value="{{ old('tema') }}"
                        class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm text-zinc-900
                               placeholder:text-zinc-500 outline-none 
                                transition-all duration-200
                               @error('tema') border-red-400 focus:ring-red-400 @enderror" />
                    @error('tema')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Idioma --}}
                <div class="w-full md:w-48">
                    <label for="idioma" class="block text-sm font-medium text-zinc-700 mb-1.5">
                        Idioma destino
                    </label>
                    <select id="idioma" name="idioma"
                        class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm text-zinc-900
                               outline-none
                               transition-all duration-200 bg-white
                               @error('idioma') border-red-400 focus:ring-red-400 @enderror">
                        <option value="" disabled {{ old('idioma') ? '' : 'selected' }}>Selecciona...</option>
                        <option value="Inglés" {{ old('idioma') == 'Inglés' ? 'selected' : '' }}>Inglés</option>
                        <option value="Francés" {{ old('idioma') == 'Francés' ? 'selected' : '' }}>Francés</option>
                        <option value="Alemán" {{ old('idioma') == 'Alemán' ? 'selected' : '' }}>Alemán</option>
                        <option value="Italiano" {{ old('idioma') == 'Italiano' ? 'selected' : '' }}>Italiano</option>
                        <option value="Portugués" {{ old('idioma') == 'Portugués' ? 'selected' : '' }}>Portugués</option>
                        <option value="Japonés" {{ old('idioma') == 'Japonés' ? 'selected' : '' }}>Japonés</option>
                        <option value="Chino" {{ old('idioma') == 'Chino' ? 'selected' : '' }}>Chino</option>
                    </select>
                    @error('idioma')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Boton --}}
                <div class="w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto px-8 py-3 rounded-xl font-semibold text-white text-sm
                               shadow-md transition-all duration-300 hover:bg-[#31aa55] focus:ring-2 focus:ring-[#36b85c]/50
                               active:scale-[0.98] cursor-pointer whitespace-nowrap bg-[#3bc569]">
                        Generar Flashcards
                    </button>
                </div>

            </form>
        </div>

        {{-- ===== AREA DE CARDS (abajo) ===== --}}
        <div>
            {{-- Estado vacio --}}
            <div id="empty-state"
                class="flex flex-col items-center justify-center h-64 rounded-2xl border-2 border-dashed border-[#3bc569] bg-white">
                <div class="w-12 h-12 rounded-xl mb-4 flex items-center justify-center bg-zinc-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-zinc-500">Tus flashcards aparecerán aquí</p>
                <p class="text-xs text-zinc-400 mt-1">Completa el formulario y genera tus tarjetas</p>
            </div>

            {{-- Grid de cards --}}
            <div id="flashcards-grid" class="hidden grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            </div>
        </div>

    </div>
@endsection
