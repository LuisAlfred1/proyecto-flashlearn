{{-- resources/views/pages/login.blade.php --}}
@extends('layouts.app-login')

@section('content')
    <div class="relative min-h-screen flex items-center justify-center px-4"
        style="background: linear-gradient(to bottom, #3bc56910 40%, transparent 60%);">

        {{-- Fondo de banderas --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none select-none" aria-hidden="true">
            @php
                $flags = ['🇺🇸', '🇫🇷', '🇩🇪', '🇯🇵', '🇮🇹', '🇧🇷', '🇨🇳', '🇰🇷', '🇪🇸', '🇷🇺'];
                $positions = [
                    ['top-[4%]', 'left-[3%]'],
                    ['top-[4%]', 'left-[18%]'],
                    ['top-[4%]', 'left-[33%]'],
                    ['top-[4%]', 'left-[48%]'],
                    ['top-[4%]', 'left-[63%]'],
                    ['top-[4%]', 'left-[78%]'],
                    ['top-[4%]', 'left-[91%]'],
                    ['top-[22%]', 'left-[8%]'],
                    ['top-[22%]', 'left-[72%]'],
                    ['top-[22%]', 'left-[88%]'],
                    ['top-[44%]', 'left-[2%]'],
                    ['top-[44%]', 'left-[85%]'],
                    ['top-[62%]', 'left-[8%]'],
                    ['top-[62%]', 'left-[55%]'],
                    ['top-[62%]', 'left-[88%]'],
                    ['top-[80%]', 'left-[3%]'],
                    ['top-[80%]', 'left-[33%]'],
                    ['top-[80%]', 'left-[63%]'],
                    ['top-[80%]', 'left-[78%]'],
                    ['top-[80%]', 'left-[91%]'],
                ];
            @endphp
            @foreach ($positions as $i => $pos)
                <span class="absolute text-4xl opacity-[0.07] {{ $pos[0] }} {{ $pos[1] }}">
                    {{ $flags[$i % count($flags)] }}
                </span>
            @endforeach
        </div>

        {{-- Grilla de dos columnas --}}
        <div class="grid grid-cols-2 w-full max-w-6xl">
            {{-- Card de login --}}
            <div class="relative z-1 p-10 w-full max-w-md">

                {{-- Logo --}}
                <div class="text-center mb-7">
                    <div class="inline-flex items-center justify-center w-13 h-13 rounded-2xl mb-4"
                        style="width: 70px; height: 70px;">
                    </div>
                    <h1 class="text-2xl font-semibold text-zinc-900">Bienvenido</h1>
                    <p class="text-sm text-zinc-500 mt-1">Inicia sesión para guardar tus flashcards</p>
                </div>

                {{-- Botón Google --}}
                <a href="{{ route('auth.google') }}"
                    class="flex items-center justify-center gap-3 w-full py-2.5 px-4
                  border border-zinc-200 bg-white hover:bg-zinc-50 transition-colors
                  text-sm font-medium text-zinc-700 cursor-pointer">
                    <svg width="18" height="18" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                            fill="#4285F4" />
                        <path
                            d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                            fill="#34A853" />
                        <path
                            d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                            fill="#FBBC05" />
                        <path
                            d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                            fill="#EB4335" />
                    </svg>
                    Continuar con Google
                </a>

                <p class="text-center text-xs text-zinc-400 mt-5 leading-relaxed">
                    Al continuar, aceptas nuestros términos de uso.<br>
                    Tu cuenta de Google se usará para iniciar sesión.
                </p>

            </div>

            {{-- Imagen decorativa --}}
            <div class="hidden md:block relative">
                <img src="{{ asset('images/heroNuevo.png') }}" alt="Login Illustration"
                    class="w-full h-full object-cover">
            </div>
        </div>


    </div>
@endsection
