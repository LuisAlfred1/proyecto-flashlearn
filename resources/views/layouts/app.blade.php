<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FlashLearn - Aprende de forma efectiva</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cabinet-grotesk:400,500,700,800|instrument-sans:400,500"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased">

    {{-- ===================== NAVBAR ===================== --}}
    <x-navbar />

    {{-- ===================== CONTENIDO PRINCIPAL ===================== --}}
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- Page Header (opcional) --}}
        @hasSection('header')
            <div class="mb-8">
                @yield('header')
            </div>
        @endif

        {{-- Slot principal --}}
        @yield('content')

    </main>
    {{-- =================== FIN CONTENIDO =================== --}}


    {{-- ===================== FOOTER ===================== --}}
    <footer class="mt-auto border-t border-zinc-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-zinc-400">
                &copy; {{ date('Y') }} FlashLearn. Todos los derechos reservados.
            </p>
        </div>
    </footer>
    {{-- =================== FIN FOOTER =================== --}}
</body>

</html>
