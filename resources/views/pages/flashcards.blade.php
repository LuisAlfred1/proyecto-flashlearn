{{-- resources/views/pages/flashcards.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="py-8 md:py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Titulo de pagina --}}
        <div class="text-center mb-6 md:mb-10">
            <h1 class="text-2xl md:text-3xl font-bold text-zinc-900">Genera tus Flashcards</h1>
            <p class="text-sm text-zinc-500 mt-2">Elige un tema e idioma y la IA hará el resto</p>
        </div>

        {{-- ===== FORMULARIO ===== --}}
        <div class="bg-white rounded-2xl shadow border border-zinc-100 p-4 md:p-6 mb-6 md:mb-8">
            <form id="flashcard-form" class="flex flex-col gap-4">
                @csrf

                {{-- Fila superior: Tema + Idioma --}}
                <div class="flex flex-col md:flex-row gap-4">

                    {{-- Tema --}}
                    <div class="flex-1">
                        <label for="tema" class="block text-sm font-medium text-zinc-700 mb-1.5">
                            Tema de estudio
                        </label>
                        <input type="text" id="tema" name="tema" placeholder="Ej: Comida en un restaurante..."
                            value="{{ old('tema') }}"
                            class="w-full rounded-xl border border-zinc-300 px-4 py-3 text-sm text-zinc-900
                                   placeholder:text-zinc-500 outline-none transition-all duration-200
                                   @error('tema') border-red-400 @enderror" />
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
                                   outline-none transition-all duration-200 bg-white
                                   @error('idioma') border-red-400 @enderror">
                            <option value="" disabled {{ old('idioma') ? '' : 'selected' }}>Selecciona...</option>
                            <option value="Inglés" {{ old('idioma') == 'Inglés' ? 'selected' : '' }}>Inglés</option>
                            <option value="Francés" {{ old('idioma') == 'Francés' ? 'selected' : '' }}>Francés</option>
                            <option value="Alemán" {{ old('idioma') == 'Alemán' ? 'selected' : '' }}>Alemán</option>
                            <option value="Italiano" {{ old('idioma') == 'Italiano' ? 'selected' : '' }}>Italiano</option>
                            <option value="Portugués" {{ old('idioma') == 'Portugués' ? 'selected' : '' }}>Portugués
                            </option>
                            <option value="Japonés" {{ old('idioma') == 'Japonés' ? 'selected' : '' }}>Japonés</option>
                        </select>
                        @error('idioma')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Botón: ancho completo en móvil --}}
                <button type="submit"
                    class="w-full md:w-auto px-8 py-3 rounded-xl font-semibold text-white text-sm
                           transition-all duration-300 hover:bg-[#31aa55] active:scale-[0.98]
                           cursor-pointer bg-[#3bc569]">
                    Generar Flashcards
                </button>

            </form>
        </div>

        {{-- ===== AREA DE CARDS ===== --}}
        <div>
            {{-- Estado vacío --}}
            <div id="empty-state"
                class="flex flex-col items-center justify-center h-48 md:h-64 rounded-2xl
                       border-2 border-dashed border-[#3bc569] bg-white">
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
            <div id="flashcards-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-4">
                {{-- Aquí se llamó al componente card.blade.php, para ver una vista previa de lo que serán las tarjetas, esto se deberá implementar con datos dinámicos a traves del backend con la API --}}
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            document.getElementById('flashcard-form').addEventListener('submit', function(e) {
                e.preventDefault(); // evita que recargue la página

                const tema = document.getElementById('tema').value;
                const language = document.getElementById('idioma').value;

                //fetch para enviar los datos al backend y obtener las flashcards generadas
                fetch('{{ route('flashcards.generate') }}', {
                        // Especifica el método HTTP, en este caso POST, porque vamos a enviar datos al servidor
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            // Agrega el token CSRF a los encabezados
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            // Indica que espera una respuesta JSON
                            'Accept': 'application/json',
                        },
                        // Envía los datos del formulario en el cuerpo de la solicitud
                        body: JSON.stringify({
                            tema,
                            language
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Respuesta en la consola del navegador

                        if (data.ok) {
                            console.log('Tema:', data.tema);
                            console.log('Idioma:', data.language);
                            // aquí luego se rendizará las flashcards
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        </script>
    @endpush
@endsection
