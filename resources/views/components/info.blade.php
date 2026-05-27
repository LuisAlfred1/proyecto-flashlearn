{{-- resources/views/components/info.blade.php --}}
<div class="bg-zinc-50 py-16 px-4 md:px-8" x-data="{ titleVisible: false }" x-intersect="titleVisible = true">
    <div id="info" class="max-w-6xl mx-auto">

        {{-- Título principal --}}
        <div class="text-center mb-12" x-show="titleVisible" x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            <h2 class="text-3xl md:text-4xl font-bold mb-3"
                style="background: linear-gradient(90deg, #0e76b3 0%, #3bc569 100%); background-clip: text; -webkit-background-clip: text; color: transparent;">
                Así de simple<br>
                ¿Cómo funciona FlashLearn?
            </h2>
            <p class="text-gray-600 text-lg">En 3 pasos tendrás tus tarjetas listas para estudiar</p>
        </div>

        {{-- Grid de 3 pasos --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16" x-data="{ step1: false, step2: false, step3: false }"
            x-intersect="step1 = true; setTimeout(() => { step2 = true; }, 150); setTimeout(() => { step3 = true; }, 300);">

            {{-- Paso 1 --}}
            <div class="text-center" x-show="step1" x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold text-white mx-auto mb-4 transform transition hover:scale-110 duration-300"
                    style="background: linear-gradient(135deg, #0e76b3 0%, #3bc569 100%);">
                    1
                </div>
                <h3 class="text-xl font-semibold mb-2" style="color: #0e76b3;">Elige tu tema</h3>
                <p class="text-gray-600">Escribe cualquier tema: "Comida en un restaurante", "Términos de programación"...</p>
                <div class="mt-3">
                    <span class="inline-flex items-center gap-1.5 bg-gray-100 rounded-full px-4 py-2 text-sm text-gray-500">
                        {{-- Heroicons: magnifying-glass --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                        Comida en un restaurante...
                    </span>
                </div>
            </div>

            {{-- Paso 2 --}}
            <div class="text-center" x-show="step2" x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold text-white mx-auto mb-4 transform transition hover:scale-110 duration-300"
                    style="background: linear-gradient(135deg, #0e76b3 0%, #3bc569 100%);">
                    2
                </div>
                <h3 class="text-xl font-semibold mb-2" style="color: #0e76b3;">Selecciona el idioma</h3>
                <p class="text-gray-600">Elige entre Inglés, Francés, Alemán, Japonés y más idiomas disponibles.</p>
                <div class="flex flex-wrap justify-center gap-2 mt-3">
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium"
                        style="background-color: #0e76b3; color: white;">
                        {{-- Heroicons: globe-alt --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253"/>
                        </svg>
                        Inglés
                    </span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium"
                        style="background-color: #3bc569; color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253"/>
                        </svg>
                        Francés
                    </span>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253"/>
                        </svg>
                        + más
                    </span>
                </div>
            </div>

            {{-- Paso 3 --}}
            <div class="text-center" x-show="step3" x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold text-white mx-auto mb-4 transform transition hover:scale-110 duration-300"
                    style="background: linear-gradient(135deg, #0e76b3 0%, #3bc569 100%);">
                    3
                </div>
                <h3 class="text-xl font-semibold mb-2" style="color: #0e76b3;">Estudia tus flashcards</h3>
                <p class="text-gray-600">La IA genera 10 tarjetas con palabra, traducción y ejemplo de uso real.</p>
                <div class="mt-3 bg-blue-50 rounded-xl p-3 inline-block border border-blue-100">
                    <div class="flex items-center gap-2 mb-1">
                        {{-- Heroicons: rectangle-stack --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="#0e76b3" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3"/>
                        </svg>
                        <p class="font-semibold text-sm" style="color: #0e76b3;">Fork — Tenedor</p>
                    </div>
                    <p class="text-xs text-gray-500 italic">"Could I have a fork, please?"</p>
                </div>
            </div>
        </div>

        {{-- Características (4 columnas) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-8 border-t border-gray-200"
            x-data="{ feature1: false, feature2: false, feature3: false, feature4: false }"
            x-intersect="feature1 = true; setTimeout(() => { feature2 = true; }, 100); setTimeout(() => { feature3 = true; }, 200); setTimeout(() => { feature4 = true; }, 300);">

            {{-- Feature 1: Generado por IA --}}
            <div class="text-center p-4 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300"
                x-show="feature1" x-transition:enter="transition ease-out duration-600"
                x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex justify-center mb-2">
                    {{-- Heroicons: cpu-chip --}}
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="#0e76b3" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"/>
                        </svg>
                    </div>
                </div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Generado por IA</h4>
                <p class="text-sm text-gray-500">Vocabulario relevante al tema elegido</p>
            </div>

            {{-- Feature 2: Traducción + ejemplo --}}
            <div class="text-center p-4 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300"
                x-show="feature2" x-transition:enter="transition ease-out duration-600"
                x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex justify-center mb-2">
                    {{-- Heroicons: document-text --}}
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="#0e76b3" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                    </div>
                </div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Traducción + ejemplo</h4>
                <p class="text-sm text-gray-500">Cada tarjeta incluye uso en oración real</p>
            </div>

            {{-- Feature 3: Sin recargar --}}
            <div class="text-center p-4 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300"
                x-show="feature3" x-transition:enter="transition ease-out duration-600"
                x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex justify-center mb-2">
                    {{-- Heroicons: bolt --}}
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="#0e76b3" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Sin recargar la página</h4>
                <p class="text-sm text-gray-500">Tarjetas interactivas en tiempo real</p>
            </div>

            {{-- Feature 4: Múltiples idiomas --}}
            <div class="text-center p-4 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300"
                x-show="feature4" x-transition:enter="transition ease-out duration-600"
                x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="flex justify-center mb-2">
                    {{-- Heroicons: globe-americas --}}
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="#0e76b3" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253"/>
                        </svg>
                    </div>
                </div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Múltiples idiomas</h4>
                <p class="text-sm text-gray-500">Inglés, Francés, Alemán, Japonés y más</p>
            </div>

        </div>

        {{-- Nota del fondo --}}
        <div class="text-center mt-8 text-xs text-gray-400">
            <span class="inline-block px-2 py-1 bg-zinc-100 rounded">© FlashLearn</span>
        </div>
    </div>
</div>