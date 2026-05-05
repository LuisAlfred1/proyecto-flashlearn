<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;

//Luis: Añadí la ruta para la página de inicio (es una bienvenida a los usuarios)
Route::get('/', function () {
    return view('pages.home');      // carpeta.archivo
});

//Luis: Agregue /flashcards para mostrar la página de flashcards (habrá un boton en la página de inicio para ir a esta página)
Route::get('/flashcards', [FlashcardController::class, 'index']);

//agregué la ruta para generar las flashcards, esta ruta se llamará desde el fetch en el archivo flashcards.blade.php
Route::post('/generate', [FlashcardController::class, 'generate'])->name('flashcards.generate');
