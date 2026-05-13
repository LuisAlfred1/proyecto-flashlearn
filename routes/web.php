<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\SocialAuthController; 
use App\Http\Controllers\FlashcardSessionController;

//Luis: Añadí la ruta para la página de inicio (es una bienvenida a los usuarios)
Route::get('/', function () {
    return view('pages.home');
});

//Luis: Agregue /flashcards para mostrar la página de flashcards (habrá un boton en la página de inicio para ir a esta página)
Route::get('/flashcards', [FlashcardController::class, 'index']);

//agregué la ruta para generar las flashcards, esta ruta se llamará desde el fetch en el archivo flashcards.blade.php
Route::post('/generate', [FlashcardController::class, 'generate'])->name('flashcards.generate');

//Ruta para la página de login, esta ruta se llamará desde el botón de login en la página de inicio
Route::get('/login', function () {
    return view('pages.login');
})->name('login');

//Google OAuth.

//redirige al login de Google.
Route::get('/auth/google', [SocialAuthController::class, 'redirect'])->name('auth.google');

//respuesta de Google.
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('auth.google.callback');

//cierra sesión (método POST).
Route::post('/logout', [SocialAuthController::class, 'logout'])->name('auth.logout');

//Ruta para la página de perfil, esta ruta se llamará desde el botón de perfil en la barra de navegación
Route::get('/profile', function () {
    return view('pages.profile'); 
})->name('profile');

//Ruta para la página de mis flashcards, esta ruta se llamará desde el botón de mis flashcards en la barra de navegación
Route::get('/mis-flashcards', function () {
    return view('pages.mis-flashcards');
})->name('flashcards.mis');

//Rutas para guardar, consultar y eliminar sesiones de flashcards (sin middleware temporalmente para pruebas).
Route::post('/flashcards/save', [FlashcardSessionController::class, 'store'])->name('flashcards.save');
Route::get('/flashcards/my-sessions', [FlashcardSessionController::class, 'index'])->name('flashcards.sessions');
Route::get('/flashcards/my-sessions/{session}', [FlashcardSessionController::class, 'show'])->name('flashcards.session.show');
Route::delete('/flashcards/my-sessions/{session}', [FlashcardSessionController::class, 'destroy'])->name('flashcards.session.destroy');