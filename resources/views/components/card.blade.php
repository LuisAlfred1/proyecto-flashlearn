{{-- resources/views/components/card.blade.php --}}
@props(['palabra', 'traduccion', 'ejemplo', 'idioma' => 'Inglés'])

<div
    class="bg-white border border-[#3bc569] rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col gap-3">

    <div class="flex justify-between items-center">
        {{-- Palabra --}}
        <h3 class="text-lg font-bold text-zinc-900">{{ $palabra }}</h3>

        {{-- Icono de sonido --}}
        <button class="text-zinc-400 hover:text-zinc-600 transition-colors hover:scale-110 cursor-pointer" title="Escuchar pronunciación">
            <img src="{{ asset('images/speaker.svg') }}" class="w-5 h-5" alt="Icono de sonido">
        </button>
    </div>

    {{-- Traduccion --}}
    <p class="text-sm text-zinc-700">{{ $traduccion }}</p>

    {{-- Ejemplo --}}
    <div class="border-t border-zinc-100 pt-3 mt-auto">
        <p class="text-xs text-zinc-600 italic">"{{ $ejemplo }}"</p>
    </div>

</div>
