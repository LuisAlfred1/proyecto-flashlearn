<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashcardController;

Route::get('/', [FlashcardController::class, 'index']);
Route::post('/generate', [FlashcardController::class, 'generate']);