{{-- resources/views/components/footer.blade.php --}}

<footer class="bg-linear-to-r from-[#0e76b3] to-[#3bc569] mt-16">

    {{-- CTA --}}
    <div class="">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                ¿Listo para aprender un nuevo idioma?
            </h2>
            <p class="text-zinc-200 text-sm md:text-base max-w-xl mx-auto mb-4">
                Genera tus primeras flashcards en segundos. Sin registro, sin complicaciones.
                Solo elige un tema y empieza a aprender.
            </p>
        </div>
    </div>

    <div>
        <div class="mx-auto max-w-7xl text-center">
            <a href="{{ url('/flashcards') }}"
                class="inline-block px-6 py-3 border-2 border-white text-white bg-white/10 hover:bg-white/20 font-semibold rounded-full
                    transition-all">
                Generar flashcards
            </a>
        </div>
    </div>

    {{-- Logo + links + redes --}}
    <div class="border-b border-[#f8f8f8]/50">
        <div
            class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4
                    flex flex-col md:flex-row items-center justify-between gap-4">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <span class="text-base font-bold text-white">FlashLearn</span>
            </a>

            {{-- Redes sociales --}}
            <div class="flex items-center gap-2">
                {{-- GitHub --}}
                <a href="https://github.com/LuisAlfred1/proyecto-flashlearn.git" target="_blank"
                    class="w-8 h-8 flex items-center justify-center bg-white/40
                        hover:bg-black/30 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577
                                 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.385-1.335-1.755-1.335-1.755
                                 -1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305
                                 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93
                                 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322
                                 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405
                                 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84
                                 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81
                                 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 21.795
                                 24 17.295 24 12c0-6.63-5.37-12-12-12" />
                    </svg>
                </a>

                {{-- Instagram --}}
                <a href="#" target="_blank"
                    class="w-8 h-8 flex items-center justify-center bg-white/40
                            hover:bg-black/30 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919
                                 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069
                                 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07
                                 -3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92
                                 -.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227
                                 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741
                                 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741
                                 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333
                                 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782
                                 -2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667
                                 -.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12
                                 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12
                                 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881
                                 1.44 1.44 0 0 0 0-2.881z" />
                    </svg>
                </a>

                {{-- LinkedIn --}}
                <a href="#" target="_blank"
                    class="w-8 h-8 flex items-center justify-center bg-white/40
                        hover:bg-black/30 hover:text-white transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853
                                 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9
                                 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337
                                 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063
                                 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0
                                 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24
                                 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    {{-- Copyright --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
        <p class="text-center text-xs text-zinc-100">
            &copy; {{ date('Y') }} FlashLearn. Todos los derechos reservados.
        </p>
    </div>

</footer>
