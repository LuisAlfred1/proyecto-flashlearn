{{-- resources/views/pages/login.blade.php --}}
@extends('layouts.app-login')

@section('content')
    {{-- Agregamos min-h-screen para que ocupe todo el alto y evite el fondo blanco abajo --}}
    <div class="min-h-screen w-full flex">

        {{-- Contenedor principal en dos columnas que se estiran al 100% del alto --}}
        <div class="grid md:grid-cols-2 w-full">

            {{-- Columna Izquierda: Login --}}
            <div class="bg-white p-8 md:p-12 flex flex-col justify-center items-center">

                {{-- Logo e Ilustración --}}
                <div class="text-center mb-6 w-full flex flex-col items-center">
                    <div class="flex justify-center items-center mb-6">
                        <img class="w-full max-w-[400px] object-contain" src="{{ asset('images/heroNuevo.png') }}"
                            alt="FlashLearn - Tarjetas de vocabulario con IA" />
                    </div>
                    <h1 class="text-4xl font-extrabold text-zinc-950 tracking-tight">Bienvenido</h1>
                    <p class="text-md text-zinc-600 mt-3">Inicia sesión para guardar y ver tus flashcards.</p>
                </div>

                {{-- Botón Google --}}
                <div class="w-full max-w-sm">
                    <a href="{{ route('auth.google') }}"
                        class="flex items-center justify-center gap-3 w-full py-3 px-6
                         border border-zinc-300 bg-white hover:bg-zinc-200 hover:border-zinc-300 transition-all
                         text-lg font-semibold text-zinc-800 cursor-pointer mb-3">
                        <svg width="24" height="24" viewBox="0 0 256 262">
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

                    <a href="/flashcards"
                        class="flex items-center justify-center gap-3 w-full py-3 px-6
                         border-2 border-zinc-300 bg-zinc-100 hover:border-2 hover:border-zinc-400 transition-all
                         text-lg font-semibold text-zinc-800 cursor-pointer mb-3">
                        Continuar sin cuenta
                    </a>

                    <p class="text-center text-sm text-zinc-500 leading-relaxed">
                        Al continuar aceptas nuestros <span class="underline">términos de uso</span>.
                        Tu cuenta de Google se usará para iniciar sesión.
                    </p>
                </div>
            </div>

            {{-- Columna Derecha: Panel de Información --}}
            <div class="relative text-white flex flex-col justify-center items-center p-12 overflow-hidden"
                style="background: linear-gradient(135deg, #0f766e 0%, #10b981 100%);">

                {{-- Marca de agua de códigos de país --}}
                <div
                    class="absolute inset-0 grid grid-cols-4 gap-x-8 gap-y-16 p-10 opacity-[0.05] text-5xl font-black pointer-events-none select-none">
                    <div>US</div>
                    <div>FR</div>
                    <div>DE</div>
                    <div>JP</div>
                    <div>IT</div>
                    <div></div>
                    <div></div>
                    <div>BR</div>
                    <div>CN</div>
                    <div></div>
                    <div></div>
                    <div>CN</div>
                    <div>ES</div>
                    <div></div>
                    <div></div>
                    <div>RU</div>
                    <div>FR</div>
                    <div>US</div>
                    <div></div>
                    <div>DE</div>
                </div>

                {{-- Contenido central --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div
                        class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center border border-white/20 mb-8 shadow-inner backdrop-blur-sm">
                        <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M2 12h20" />
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                    </div>

                    <h2 class="text-5xl font-bold tracking-tight mb-6">Aprende sin límites</h2>
                    <p class="text-xl text-teal-50 max-w-md leading-relaxed mb-12 opacity-90">
                        Genera flashcards de vocabulario en cualquier idioma con inteligencia artificial
                    </p>
                </div>

                {{-- Lista de características --}}
                <div class="relative z-10 space-y-4 w-full max-w-md">
                    <div
                        class="flex items-center gap-4 bg-white/10 p-5 rounded-2xl border border-white/10 backdrop-blur-md">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                            ✓
                        </div>
                        <p class="text-lg font-medium">Inglés, Francés, Alemán, Japonés y más</p>
                    </div>

                    <div
                        class="flex items-center gap-4 bg-white/10 p-5 rounded-2xl border border-white/10 backdrop-blur-md">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                            ✓
                        </div>
                        <p class="text-lg font-medium">Traducción y ejemplo de uso real</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
