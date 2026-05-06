{{-- resources/views/components/card.blade.php --}}
@props(['palabra', 'traduccion', 'ejemplo', 'idioma' => 'Inglés'])

<div
    class="bg-white border border-zinc-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow flex flex-col gap-3">

    <div class="flex justify-between items-center">
        {{-- Palabra --}}
        <h3 class="text-2xl font-bold text-zinc-900">{{ $palabra }}</h3>

        {{-- Badge idioma --}}
        <span class="text-xs font-semibold uppercase tracking-widest" style="color: #0e76b3;">{{ $idioma }}</span>
    </div>

    {{-- Traduccion --}}
    <p class="text-sm text-zinc-500">{{ $traduccion }}</p>

    {{-- Ejemplo --}}
    <div class="border-t border-zinc-100 pt-3 mt-auto">
        <p class="text-xs text-zinc-400 italic">"{{ $ejemplo }}"</p>
    </div>

</div>
