{{-- resources/views/components/info.blade.php --}}

<div class="bg-zinc-50 py-16 px-4 md:px-8">
    <div class="max-w-6xl mx-auto">
        
        {{-- Título principal con gradiente --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-3" style="background: linear-gradient(90deg, #0e76b3 0%, #3bc569 100%); background-clip: text; -webkit-background-clip: text; color: transparent;">
                Asi de simple<br>
            ¿Cómo funciona FlashLearn?
            </h2>
            <p class="text-gray-600 text-lg">En 3 pasos tendrás tus tarjetas listas para estudiar</p>
        </div>

        {{-- Grid de 3 pasos --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            
            {{-- Paso 1 --}}
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold text-white mx-auto mb-4" style="background: linear-gradient(135deg, #0e76b3 0%, #3bc569 100%);">
                    1
                </div>
                <h3 class="text-xl font-semibold mb-2" style="color: #0e76b3;"> Elije tu tema</h3>
                <p class="text-gray-600">Escribe cualquier tema: "Comida en un restaurante", "Términos de programación"...</p>
                <div class="mt-3">
                    <span class="inline-block bg-gray-100 rounded-full px-4 py-2 text-sm text-gray-500">
                        📚 Comida en un restaurante...
                    </span>
                </div>
            </div>

            {{-- Paso 2 --}}
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold text-white mx-auto mb-4" style="background: linear-gradient(135deg, #0e76b3 0%, #3bc569 100%);">
                    2
                </div>
                <h3 class="text-xl font-semibold mb-2" style="color: #0e76b3;">Selecciona el idioma</h3>
                <p class="text-gray-600">Elige entre Inglés, Francés, Alemán, Japonés y más idiomas disponibles.</p>
                <div class="flex flex-wrap justify-center gap-2 mt-3">
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium" style="background-color: #0e76b3; color: white;">Inglés</span>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium" style="background-color: #3bc569; color: white;">Francés</span>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-600">Japonés</span>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-600">+ más</span>
                </div>
            </div>

            {{-- Paso 3 --}}
            <div class="text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-bold text-white mx-auto mb-4" style="background: linear-gradient(135deg, #0e76b3 0%, #3bc569 100%);">
                    3
                </div>
                <h3 class="text-xl font-semibold mb-2" style="color: #0e76b3;">Estudia tus flashcards</h3>
                <p class="text-gray-600">La IA genera 10 tarjetas con palabra, traducción y ejemplo de uso real.</p>
                <div class="mt-3 bg-yellow-50 rounded-lg p-3 inline-block">
                    <p class="font-semibold" style="color: #0e76b3;">🍴 Fork — Tenedor</p>
                    <p class="text-sm text-gray-500 italic">"Could I have a fork, please?"</p>
                </div>
            </div>
        </div>

        {{-- Sección de características (4 columnas) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-8 border-t border-gray-200">
            
            <div class="text-center p-4 rounded-lg hover:shadow-lg transition-shadow">
                <div class="text-3xl mb-2">🤖</div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Generado por IA</h4>
                <p class="text-sm text-gray-500">Vocabulario relevante al tema elegido</p>
            </div>

            <div class="text-center p-4 rounded-lg hover:shadow-lg transition-shadow">
                <div class="text-3xl mb-2">📝</div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Traducción + ejemplo</h4>
                <p class="text-sm text-gray-500">Cada tarjeta incluye uso en oración real</p>
            </div>

            <div class="text-center p-4 rounded-lg hover:shadow-lg transition-shadow">
                <div class="text-3xl mb-2">🔄</div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Sin recargar la página</h4>
                <p class="text-sm text-gray-500">Tarjetas interactivas en tiempo real</p>
            </div>

            <div class="text-center p-4 rounded-lg hover:shadow-lg transition-shadow">
                <div class="text-3xl mb-2">🌍</div>
                <h4 class="font-semibold mb-1" style="color: #0e76b3;">Múltiples idiomas</h4>
                <p class="text-sm text-gray-500">Inglés, Francés, Alemán, Japonés y más</p>
            </div>
        </div>

        {{-- Nota del fondo --}}
        <div class="text-center mt-8 text-xs text-gray-400">
            <span class="inline-block px-2 py-1 bg-zinc-100 rounded"> © FlashLearn</span>
        </div>
    </div>
</div>