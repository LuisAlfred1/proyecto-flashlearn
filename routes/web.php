<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\SocialAuthController; // <- agregar esta línea

//Luis: Añadí la ruta para la página de inicio (es una bienvenida a los usuarios)
Route::get('/', function () {
    return view('pages.home');
});

//Luis: Agregue /flashcards para mostrar la página de flashcards (habrá un boton en la página de inicio para ir a esta página)
Route::get('/flashcards', [FlashcardController::class, 'index']);

//agregué la ruta para generar las flashcards, esta ruta se llamará desde el fetch en el archivo flashcards.blade.php
Route::post('/generate', [FlashcardController::class, 'generate'])->name('flashcards.generate');

//Google OAuth.

//redirige al login de Google.
Route::get('/auth/google', [SocialAuthController::class, 'redirect'])->name('auth.google');

//respuesta de Google.
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('auth.google.callback');

//cierra sesión (método POST).
Route::post('/logout', [SocialAuthController::class, 'logout'])->name('auth.logout');